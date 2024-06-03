<?php

namespace Callmeaf\Package\Http\Controllers\V1\Api;

use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Package\Events\PackageDestroyed;
use Callmeaf\Package\Events\PackageIndexed;
use Callmeaf\Package\Events\PackageShowed;
use Callmeaf\Package\Events\PackageStatusUpdated;
use Callmeaf\Package\Events\PackageStored;
use Callmeaf\Package\Events\PackageUpdated;
use Callmeaf\Package\Http\Requests\V1\Api\PackageDestroyRequest;
use Callmeaf\Package\Http\Requests\V1\Api\PackageIndexRequest;
use Callmeaf\Package\Http\Requests\V1\Api\PackageShowRequest;
use Callmeaf\Package\Http\Requests\V1\Api\PackageStatusUpdateRequest;
use Callmeaf\Package\Http\Requests\V1\Api\PackageStoreRequest;
use Callmeaf\Package\Http\Requests\V1\Api\PackageUpdateRequest;
use Callmeaf\Package\Models\Package;
use Callmeaf\Package\Services\V1\PackageService;
use Callmeaf\Product\Services\V1\ProductService;
use Illuminate\Support\Facades\Log;

class PackageController extends ApiController
{
    protected PackageService $packageService;
    protected ProductService $productService;
    public function __construct()
    {
        app(config('callmeaf-package.middlewares.package'))($this);
        $this->packageService = app(config('callmeaf-package.service'));
        $this->productService = app(config('callmeaf-product.service'));
    }

    public function index(PackageIndexRequest $request)
    {
        try {
            $packages = $this->packageService->all(
                relations: config('callmeaf-package.resources.index.relations'),
                columns: config('callmeaf-package.resources.index.columns'),
                filters: $request->validated(),
                events: [
                    PackageIndexed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: config('callmeaf-package.resources.index.attributes'));
            return apiResponse([
                'packages' => $packages,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function store(PackageStoreRequest $request)
    {
        try {
            $package = $this->packageService->create(data: $request->validated(),events: [
                PackageStored::class
            ])->getModel(asResource: true,attributes: config('callmeaf-package.resources.store.attributes'),relations: config('callmeaf-package.resources.store.relations'));
            return apiResponse([
                'package' => $package,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $package->responseTitles('store'),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(PackageShowRequest $request,Package $package)
    {
        try {
            $package = $this->packageService->setModel($package)->getModel(
                asResource: true,
                attributes: config('callmeaf-package.resources.show.attributes'),
                relations: config('callmeaf-package.resources.show.relations'),
                events: [
                    PackageShowed::class,
                ],
            );
            return apiResponse([
                'package' => $package,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function update(PackageUpdateRequest $request,Package $package)
    {
        try {
            $package = $this->packageService->setModel($package)->update(data: $request->validated(),events: [
                PackageUpdated::class,
            ])->getModel(asResource: true,attributes: config('callmeaf-package.resources.update.attributes'),relations: config('callmeaf-package.resources.update.relations'));
            return apiResponse([
                'package' => $package,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $package->responseTitles('update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(PackageStatusUpdateRequest $request,Package $package)
    {
        try {
            $this->productService->setModel($package->product)->update([
                'status' => $request->get('status'),
            ]);
            $package = $this->packageService->setModel($package->load('product'))->getModel(asResource: true,attributes: config('callmeaf-package.resources.status_update.attributes'),relations: config('callmeaf-package.resources.status_update.relations'),events: [
                PackageStatusUpdated::class
            ]);
            return apiResponse([
                'package' => $package,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $package->responseTitles('status_update')
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(PackageDestroyRequest $request,Package $package)
    {
        try {
            $this->productService->setModel($package->product)->forceDelete();
            $package = $this->packageService->setModel($package)->getModel(asResource: true,attributes: config('callmeaf-package.resources.destroy.attributes'),events: [
                PackageDestroyed::class,
            ]);
            return apiResponse([
                'package' => $package,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $package->responseTitles('destroy',$package->product->title)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


}
