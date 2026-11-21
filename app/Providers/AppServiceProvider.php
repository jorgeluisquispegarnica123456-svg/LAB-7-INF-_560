<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (!$this->app->runningInConsole()) {
            $host = request()->header("x-forwarded-host") ?? request()->getHost();
            $proto = request()->header("x-forwarded-proto") ?? request()->getScheme();

            if (str_contains($host, "github.dev") || str_contains($host, "githubpreview.dev")) {
                URL::forceRootUrl("https://" . $host);
                URL::forceScheme("https");
            } else {
                URL::forceRootUrl($proto . "://" . $host);
            }
        }
    }
}