<?php

namespace App\Providers;

use App\Interfaces\UploadFileServiceInterface;
use App\Services\UploadFileToAwsStorageService;
use App\Services\UploadFileToLocalStorageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UploadFileServiceInterface::class, function () {
            return new UploadFileToLocalStorageService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
