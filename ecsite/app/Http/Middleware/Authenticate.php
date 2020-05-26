<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    /**
     * consumerのログインURL
     *
     * @var string
     */
    protected $consumer_route = 'consumer.login';

    /**
     * supplierのログインURL
     *
     * @var string
     */
    protected $supplier_route = 'supplier.login';

    /**
     * managerのログインURL
     *
     * @var string
     */
    protected $manager_route = 'manager.login';

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (Route::is('consumer.*')) {
                return route($this->consumer_route);
            } elseif (Route::is('supplier.*')) {
                return route($this->supplier_route);
            } elseif (Route::is('manager.*')) {
                return route($this->manager_route);
            }
        }
    }
}
