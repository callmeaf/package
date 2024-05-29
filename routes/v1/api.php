<?php

use \Illuminate\Support\Facades\Route;

Route::prefix(config('callmeaf-base.api.prefix_url'))->as(config('callmeaf-base.api.prefix_route_name'))->middleware(config('callmeaf-base.api.middlewares'))->group(function() {
    Route::apiResource('packages',config('callmeaf-package.controllers.packages'));
    Route::prefix('packages')->as('packages.')->controller(config('callmeaf-package.controllers.packages'))->group(function() {
        Route::prefix('{package}')->group(function() {
            Route::patch('/status','statusUpdate')->name('status_update');
        });
    });
});
