<?php

return [
    'model' => \Callmeaf\Package\Models\Package::class,
    'model_resource' => \Callmeaf\Package\Http\Resources\V1\Api\PackageResource::class,
    'model_resource_collection' => \Callmeaf\Package\Http\Resources\V1\Api\PackageCollection::class,
    'service' => \Callmeaf\Package\Services\V1\PackageService::class,
    'default_values' => [
        //
    ],
    'events' => [
        \Callmeaf\Package\Events\PackageIndexed::class => [
            // listeners
        ],
        \Callmeaf\Package\Events\PackageStored::class => [
            // listeners
        ],
        \Callmeaf\Package\Events\PackageShowed::class => [
            // listeners
        ],
        \Callmeaf\Package\Events\PackageUpdated::class => [
            // listeners
        ],
        \Callmeaf\Package\Events\PackageStatusUpdated::class => [
            // listeners
        ],
        \Callmeaf\Package\Events\PackageDestroyed::class => [
            // listeners
        ],
    ],
    'validations' => [
        'package' => \Callmeaf\Package\Utilities\V1\Api\Package\PackageFormRequestValidator::class,
    ],
    'resources' => [
        'package' => \Callmeaf\Package\Utilities\V1\Api\Package\PackageResources::class,
    ],
    'controllers' => [
        'packages' => \Callmeaf\Package\Http\Controllers\V1\Api\PackageController::class,
    ],
    'form_request_authorizers' => [
        'package' => \Callmeaf\Package\Utilities\V1\Api\Package\PackageFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'package' => \Callmeaf\Package\Utilities\V1\Api\Package\PackageControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\Package\Utilities\V1\Api\Package\PackageSearcher::class,
];
