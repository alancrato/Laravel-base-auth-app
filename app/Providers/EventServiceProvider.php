<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Dingo\Api\Event\ResponseWasMorphed::class => [
            \App\Listeners\AddTokenToHeaderListener::class,
        ],
        \App\Events\PayPalPaymentApproved::class => [
            \App\Listeners\CreateOrderListener::class
        ],
        \Prettus\Repository\Events\RepositoryEntityCreated::class => [
            \App\Listeners\CreateSubscriptionListener::class,
            \App\Listeners\CreatePayPalWebProfileListener::class
        ],
        \Prettus\Repository\Events\RepositoryEntityUpdated::class => [
            \App\Listeners\UpdatePayPalWebProfileListener::class
        ],
        \Prettus\Repository\Events\RepositoryEntityDeleted::class => [
            \App\Listeners\DeletePayPalWebProfileListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
