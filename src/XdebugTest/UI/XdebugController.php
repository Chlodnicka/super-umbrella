<?php

declare(strict_types=1);

namespace SuperUmbrella\XdebugTest\UI;

use SuperUmbrella\XdebugTest\XdebugService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class XdebugController extends AbstractController
{
    public function index(Request $request, XdebugService $service): Response
    {
        $test = $request->query->get('test');
        $service->run($test);
        return new JsonResponse('OK');
    }
}
