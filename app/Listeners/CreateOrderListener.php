<?php

namespace App\Listeners;

use App\Events\PayPalPaymentApproved;
use App\Repositories\OrderRepository;

class CreateOrderListener
{
    /**
     * @var OrdersRepository
     */
    private $repository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OrderRepository $repository)
    {
        //
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  PayPalPaymentApproved  $event
     * @return void
     */
    public function handle(PayPalPaymentApproved $event)
    {
        $plan = $event->getPlan();
        $order = $this->repository->create([
            'user_id' => \Auth::guard('api')->user()->id,
            'value' => $plan->value,
            'code' => $event->getPayment()->getId()
        ]);
        $event->setOrder($order);
    }
}
