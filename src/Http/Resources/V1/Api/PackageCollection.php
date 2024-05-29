<?php

namespace Callmeaf\Package\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;

class PackageCollection extends ResourceCollection
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function($package) {
                return toArrayResource(data: [
                    'id' => fn() => $package->id,
                    'product_id' => fn() => $package->product_id,
                    'type' => fn() => $package->type,
                    'type_text' => fn() => $package->typeText,
                    'deadline' => fn() => $package->deadline,
                    'created_at' => fn() => $package->created_at,
                    'created_at_text' => fn() => $package->createdAtText,
                    'updated_at' => fn() => $package->updated_at,
                    'updated_at_text' => fn() => $package->updatedAtText,
                    'image' => fn() => new (config('callmeaf-media.model_resource'))($package->image,only: $this->only['!image'] ?? []),
                    'product' => fn() => new (config('callmeaf-product.model_resource'))($package->product,only: $this->only['!product'] ?? []),
                ],only: $this->only);
            }),
        ];
    }
}
