<?php

namespace Callmeaf\Package\Utilities\V1\Api\Package;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;


class PackageControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(BaseController $controller): void
    {
        $controller->middleware([])->only([
            'index',
            'show',
        ]);
        $controller->middleware('auth:sanctum')->only([
            'store',
            'update',
            'statusUpdate',
            'destroy',
        ]);
    }
}
