<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PHPageBuilder\Extensions;

class PHPageBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
//        Extensions::registerBlock('navbar', base_path('themes/demo/blocks/navbar'));
    }

    public function boot()
    {
    }
}
