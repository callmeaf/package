<?php

namespace Callmeaf\Package\Http\Controllers\V1\Api;

use Callmeaf\Base\Enums\ResponseTitle;
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
use Callmeaf\Package\Utilities\V1\Api\Package\PackageResources;
use Callmeaf\Product\Services\V1\ProductService;

class PackageController extends ApiController
{
    protected PackageService $packageService;
    protected ProductService $productService;
    protected PackageResources $packageResources;
    public function __construct()
    {
        $this->packageService = app(config('callmeaf-package.service'));
        $this->productService = app(config('callmeaf-product.service'));
        $this->packageResources = app(config('callmeaf-package.resources.package'));
    }

    public static function middleware(): array
    {
        return app(config('callmeaf-package.middlewares.package'))();
    }

    public function index(PackageIndexRequest $request)
    {
        try {
            $resources = $this->packageResources->index();
            $packages = $this->packageService->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
                events: [
                    PackageIndexed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes());
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
            $resources = $this->packageResources->store();
            $package = $this->packageService->create(data: $request->validated(),events: [
                PackageStored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'package' => $package,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $package->responseTitles(ResponseTitle::STORE),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(PackageShowRequest $request,Package $package)
    {
        try {
            $resources = $this->packageResources->show();
            $package = $this->packageService->setModel($package)->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
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
            $resources = $this->packageResources->update();
            $package = $this->packageService->setModel($package)->update(data: $request->validated(),events: [
                PackageUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'package' => $package,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $package->responseTitles(ResponseTitle::UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(PackageStatusUpdateRequest $request,Package $package)
    {
        try {
            $resources = $this->packageResources->statusUpdate();
            $this->productService->setModel($package->product)->update([
                'status' => $request->get('status'),
            ]);
            $package = $this->packageService->setModel($package->load('product'))->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations(),events: [
                PackageStatusUpdated::class
            ]);
            return apiResponse([
                'package' => $package,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $package->responseTitles(ResponseTitle::STATUS_UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(PackageDestroyRequest $request,Package $package)
    {
        try {
            $resources = $this->packageResources->destroy();
            $this->productService->setModel($package->product)->forceDelete();
            $package = $this->packageService->setModel($package)->getModel(asResource: true,attributes: $resources->attributes(),events: [
                PackageDestroyed::class,
            ]);
            return apiResponse([
                'package' => $package,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $package->responseTitles(ResponseTitle::DESTROY,$package->product->title)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }


}
