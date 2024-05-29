<?php

namespace Callmeaf\Package\Services\V1;

use Callmeaf\Base\Services\V1\BaseService;
use Callmeaf\Package\Services\V1\Contracts\PackageServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PackageService extends BaseService implements PackageServiceInterface
{
    public function __construct(?Builder $query = null, ?Model $model = null, ?Collection $collection = null, ?JsonResource $resource = null, ?ResourceCollection $resourceCollection = null, array $defaultData = [],?string $searcher = null)
    {
        parent::__construct($query, $model, $collection, $resource, $resourceCollection, $defaultData,$searcher);
        $this->query = app(config('callmeaf-package.model'))->query();
        $this->resource = config('callmeaf-package.model_resource');
        $this->resourceCollection = config('callmeaf-package.model_resource_collection');
        $this->defaultData = config('callmeaf-package.default_values');
        $this->searcher = config('callmeaf-package.searcher');
    }

}
