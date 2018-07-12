<?php

namespace CodePress\CodeTag\Providers;

use Illuminate\Support\ServiceProvider;
use CodePress\CodeTag\Repository\TagRepositoryInterface;
use CodePress\CodeTag\Repository\TagRepositoryEloquent;

/**
 * Description of CodeTagServiceProvider
 *
 * @author gabriel
 */
class CodeTagServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([__DIR__ . '/../../resources/migrations/' => base_path('database/migrations')], 'migrations');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/codetag', 'codetag');
        require __DIR__ . '/../routes.php';
    }

    public function register()
    {
        $this->app->bind(TagRepositoryInterface::class, TagRepositoryEloquent::class);
    }

}
