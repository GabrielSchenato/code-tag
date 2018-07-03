<?php

namespace CodePress\CodeTags\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Description of CodeCategoryServiceProvider
 *
 * @author gabriel
 */
class CodeTagsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([__DIR__ . '/../../resources/migrations/' => base_path('database/migrations')], 'migrations');
    }

    public function register()
    {
        
    }

}
