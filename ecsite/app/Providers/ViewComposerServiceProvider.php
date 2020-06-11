<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\Consumer as Consumer;
use App\Http\ViewComposers\Supplier as Supplier;
use App\Http\ViewComposers\Manager as Manager;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composers([
            Consumer\LayoutComposer::class => 'consumer.*',
            Supplier\LayoutComposer::class => 'supplier.*',
            Manager\LayoutComposer::class => 'manager.*',
            Consumer\LayoutComposer::class => 'layouts.consumer.*',
            Supplier\LayoutComposer::class => 'layouts.supplier.*',
            Manager\LayoutComposer::class => 'layouts.manager.*',
        ]);
    }
}
