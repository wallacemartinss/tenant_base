<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * This middleware will run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        
    ];

    /**
     * The application's route middleware.
     *
     * This middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [

        //'subscription.active' => \App\Http\Middleware\CheckOrganizationSubscription::class,
        // Adicione outros middlewares conforme necessário
    ];
}
