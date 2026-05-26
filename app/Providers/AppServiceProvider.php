<?php

namespace App\Providers;

use App\Models\ContactModel;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        //
        View::composer([
            'frontend.layout.header',
            'frontend.layout.footer',
            'frontend.pages.layout.header',
            'frontend.pages.layout.footer',
        ], function ($view) {
            $contacts = collect();
            $setting = null;

            if (Schema::hasTable('contact')) {
                $contacts = ContactModel::all();
            }

            if (Schema::hasTable('website_settings')) {
                $setting = WebsiteSetting::first();
            }

            $view->with('contacts', $contacts);
            $view->with('setting', $setting);
        });
    }
}
