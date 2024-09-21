<?php

namespace Callmeaf\Package\Utilities\V1\Api\Package;

use Callmeaf\Base\Utilities\V1\Resources;

class PackageResources extends Resources
{
    public function index(): self
    {
        $this->data = [
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
        ];
        return $this;
    }

    public function store(): self
    {
        $this->data = [
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
        ];
        return $this;
    }

    public function show(): self
    {
        $this->data = [
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
        ];
        return $this;
    }

    public function update(): self
    {
        $this->data = [
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
        ];
        return $this;
    }

    public function statusUpdate(): self
    {
        $this->data = [
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
        ];
        return $this;
    }

    public function destroy(): self
    {
        $this->data = [
            'attributes' => [
                'id',
            ],
        ];
        return $this;
    }
}
