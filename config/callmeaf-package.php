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
        \Callmeaf\Package\Events\PackageStored::class => [
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
        'package' => \Callmeaf\Package\Utilities\V1\Package\Api\PackageFormRequestValidator::class,
    ],
    'resources' => [
        'index' => [
            'relations' => [
                'product'
            ],
            'columns' => [
                'id',
                'product_id',
                'type',
                'deadline',
                'created_at',
                'updated_at',
            ],
            'attributes' => [
                'id',
                'product_id',
                'type',
                'type_text',
                'deadline',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
            ],
        ],
        'store' => [
            'relations' => [
                'product'
            ],
            'attributes' => [
                'id',
                'product_id',
                'type',
                'type_text',
                'deadline',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
            ],
        ],
        'show' => [
            'relations' => [
                'product'
            ],
            'attributes' => [
                'id',
                'product_id',
                'type',
                'type_text',
                'deadline',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'summary',
                    'content',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
            ],
        ],
        'update' => [
            'relations' => [
                'product'
            ],
            'attributes' => [
                'id',
                'product_id',
                'type',
                'type_text',
                'deadline',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
            ],
        ],
        'status_update' => [
            'relations' => [
                'product'
            ],
            'attributes' => [
                'id',
                'product_id',
                'type',
                'type_text',
                'deadline',
                'created_at_text',
                'updated_at_text',
                'product',
                '!product' => [
                    'type',
                    'status',
                    'title',
                    'slug',
                    'product_id',
                    'type',
                    'type_text',
                    'status',
                    'status_text',
                    'title',
                    'slug',
                    'created_at_text',
                    'updated_at_text',
                    'published_at_text',
                    'expired_at_text',
                ],
            ],
        ],
        'destroy' => [
            'attributes' => [
                'id',
            ],
        ],
    ],
    'controllers' => [
        'packages' => \Callmeaf\Package\Http\Controllers\V1\Api\PackageController::class,
    ],
    'form_request_authorizers' => [
        'package' => \Callmeaf\Package\Utilities\V1\Package\Api\PackageFormRequestAuthorizer::class,
    ],
    'middlewares' => [
        'package' => \Callmeaf\Package\Utilities\V1\Package\Api\PackageControllerMiddleware::class,
    ],
    'searcher' => \Callmeaf\Package\Utilities\V1\Package\Api\PackageSearcher::class,
];
