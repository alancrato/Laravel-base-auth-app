<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderRequest;
use App\Models\Plan;
use App\Http\Controllers\Controller;
use App\PayPal\PaymentClient;

class PaymentsController extends Controller
{
    /**
     * @var PaymentClient
     */
    private $paymentClient;


    /**
     * PaymentsController constructor.
     * @param PaymentClient $paymentClient
     */
    public function __construct(PaymentClient $paymentClient)
    {
        $this->paymentClient = $paymentClient;
    }

    public function makePayment(Plan $plan){
        $payment = $this->paymentClient->makePayment($plan);
        return [
            'approval_url' => $payment->getApprovalLink(),
            'payment_id' => $payment->getId()
        ];
    }

    public function approvalPayment(OrderRequest $request, Plan $plan)
    {
        $order = $this->paymentClient->doPayment(
            $plan,
            $request->get('payment_id'),
            $request->get('payer_id')
        );
        return $order;
    }
}
