<?php

namespace Callmeaf\Package\Http\Resources\V1\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    public function __construct($resource,protected array|int $only = [])
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return toArrayResource(data: [
            'id' => fn() => $this->id,
            'product_id' => fn() => $this->product_id,
            'type' => fn() => $this->type,
            'type_text' => fn() => $this->typeText,
            'deadline' => fn() => $this->deadline,
            'created_at' => fn() => $this->created_at,
            'created_at_text' => fn() => $this->createdAtText,
            'updated_at' => fn() => $this->updated_at,
            'updated_at_text' => fn() => $this->updatedAtText,
            'image' => fn() => $this->image ? new (config('callmeaf-media.model_resource'))($this->image,only: $this->only['!image'] ?? []) : null,
            'product' => fn() => $this->product ? new (config('callmeaf-product.model_resource'))($this->product,only: $this->only['!product'] ?? []) : null,
        ],only: $this->only);
    }
}
