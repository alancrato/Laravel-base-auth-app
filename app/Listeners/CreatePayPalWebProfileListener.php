<?php

namespace App\Listeners;

use App\Models\PaypalWebProfile;
use App\PayPal\WebProfileClient;
use App\Repositories\PaypalWebProfileRepository;
use Prettus\Repository\Events\RepositoryEntityCreated;

class CreatePayPalWebProfileListener
{
    /**
     * @var WebProfileClient
     */
    private $webProfileClient;
    /**
     * @var PaypalWebProfileRepository
     */
    private $repository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        WebProfileClient $webProfileClient,
        PaypalWebProfileRepository $repository
    )
    {
        //
        $this->webProfileClient = $webProfileClient;
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEntityCreated  $event
     * @return void
     */
    public function handle(RepositoryEntityCreated $event)
    {
        $model = $event->getModel();
        if(!($model instanceof PaypalWebProfile)){
            return;
        }

        $payPalWebProfile = $this->webProfileClient->create($model);
        \Config::set('webprofile_created', true);
        $this->repository->update([
            'code' => $payPalWebProfile->getId()
        ],$model->id);

    }
}
