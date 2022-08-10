<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Cart\Infrastructure;

use Doctrine\DBAL\Connection;
use SuperUmbrella\Shop\Cart\Application\CartException;
use SuperUmbrella\Shop\Cart\Application\CartRepository;
use SuperUmbrella\Shop\Cart\Domain\Cart;
use SuperUmbrella\Shop\Shared\UserId;

final class CartSqlRepository implements CartRepository
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function get(UserId $userId): Cart
    {
        $payload = $this->connection->fetchOne('SELECT * FROM cart WHERE user_id = :userId OR session_id = :sessionId',
            [
                'userId' => $userId->id,
                'sessionId' => $userId->sessionId,
            ]);

        if ($payload) {
            return Cart::ofPayload($payload);
        }

        return $this->create($userId);
    }

    private function create(UserId $user): Cart
    {
        $this->connection->beginTransaction();
        try {
            $this->connection->executeStatement('INSERT INTO cart (user_id, session_id) VALUES (:userId, :sessionId);',
                [
                    'userId' => $user->id,
                    'sessionId' => $user->sessionId,
                ]);
            $id = $this->connection->lastInsertId('cart');
            $cart = Cart::create($id);
            $this->connection->commit();
            return $cart;
        } catch (\Throwable $exception) {
            $this->connection->rollBack();
            throw CartException::cannotCreateCart($exception);
        }
    }

    public function save(Cart $cart): void
    {
        $this->connection->beginTransaction();

        try {
            $this->connection->executeStatement('UPDATE cart SET ...');
            foreach ($cart->getItems() as $item) {
                $this->connection->executeStatement(
                    'INSERT INTO cart_item (cart_id, product_id, quantity) VALUES (:cartId, :productId, :quantity)',
                    [
                        'cartId' => $cart->getId(),
                        'productId' => $item->getProductId(),
                        'quantity' => $item->getQuantity()->getValue(),
                    ]);
            }
            $this->connection->commit();
        } catch (\Throwable $exception) {
            $this->connection->rollBack();
            throw CartException::cannotSaveCart($exception);
        }
    }

}