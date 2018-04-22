<?php

namespace App\Events;

use App\Models\Plan;
use PayPal\Api\Payment;

class PayPalPaymentApproved
{
    /**
     * @var Plan
     */
    private $plan;

    private $order;
    /**
     * @var Payment
     */
    private $payment;

    public function __construct(Plan $plan, Payment $payment)
    {

        $this->plan = $plan;
        $this->payment = $payment;
    }

    /**
     * @return Plan
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }
    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }

}
