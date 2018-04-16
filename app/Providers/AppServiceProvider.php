<?php

namespace App\Providers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Dingo\Api\Exception\Handler;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'prod') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->bind(
            'bootstrapper::form',
            function ($app) {
                $form = new Form(
                    $app->make('collective::html'),
                    $app->make('url'),
                    $app->make('view'),
                    $app['session.store']->token()
                );

                return $form->setSessionStore($app['session.store']);
            },
            true
        );

        $handler = app(Handler::class);
        $handler->register(function (AuthenticationException $exception){
           return response()->json(['error' => 'Unauthenticated'], 401);
        });
        $handler->register(function (JWTException $exception){
           return response()->json(['error' => $exception->getMessage()], 401);
        });
    }

}
