<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\StoreProfileController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $assetController = new AssetController();
            $profileController = new StoreProfileController();
            $profile = $profileController->getDataProfile();
            $view->with('logoPath', $assetController->getLogoPath())
                ->with('mainBannerPath', $assetController->getMainBannerPath())
                ->with('womanBannerPath', $assetController->getBannerPath('womanBanner'))
                ->with('menBannerPath', $assetController->getBannerPath('menBanner'))
                ->with('kidsBannerPath', $assetController->getBannerPath('kidsBanner'))
                ->with('otherBannerPath', $assetController->getBannerPath('otherBanner'))
                ->with('profile', $profile);
        });
    }
}
