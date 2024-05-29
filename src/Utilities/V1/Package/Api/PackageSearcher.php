<?php

namespace Callmeaf\Package\Utilities\V1\Package\Api;

use Callmeaf\Base\Utilities\V1\Contracts\SearcherInterface;
use Illuminate\Database\Eloquent\Builder;

class PackageSearcher implements SearcherInterface
{
    public function apply(Builder $query, array $filters = []): void
    {
        $filters = collect($filters)->filter(fn($item) => strlen(trim($item)));
        if($value = $filters->get('title')) {
            $query->whereHas('product',function(Builder $query) use ($value) {
                $query->where('title','like',searcherLikeValue($value));
            });
        }
        if($value = $filters->get('slug')) {
            $query->whereHas('product',function(Builder $query) use ($value) {
                $query->where('slug','like',searcherLikeValue($value));
            });
        }
    }
}
