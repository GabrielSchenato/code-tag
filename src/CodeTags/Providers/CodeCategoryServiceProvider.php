<?php

namespace CodePress\CodeCategory\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Description of CodeCategoryServiceProvider
 *
 * @author gabriel
 */
class CodeCategoryServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([__DIR__ . '/../../resources/migrations/' => base_path('database/migrations')], 'migrations');
    }

    public function register()
    {
        
    }

}
