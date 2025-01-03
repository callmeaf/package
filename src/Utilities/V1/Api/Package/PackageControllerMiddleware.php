<?php

namespace Callmeaf\Package\Utilities\V1\Api\Package;

use Callmeaf\Base\Http\Controllers\BaseController;
use Callmeaf\Base\Utilities\V1\ControllerMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class PackageControllerMiddleware extends ControllerMiddleware
{
    public function __invoke(): array
    {
        return [
            new Middleware(middleware: 'auth:sanctum',only: [
                'store',
                'update',
                'statusUpdate',
                'destroy',
            ])
        ];
    }
}
