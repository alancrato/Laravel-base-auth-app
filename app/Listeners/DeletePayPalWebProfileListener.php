<?php

namespace App\Listeners;

use Prettus\Repository\Events\RepositoryEntityDeleted;
use App\Models\PaypalWebProfile;
use App\PayPal\WebProfileClient;

class DeletePayPalWebProfileListener
{
    /**
     * @var WebProfileClient
     */
    private $webProfileClient;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(WebProfileClient $webProfileClient)
    {
        //
        $this->webProfileClient = $webProfileClient;
    }

    /**
     * Handle the event.
     *
     * @param  RepositoryEntityDeleted  $event
     * @return void
     */
    public function handle(RepositoryEntityDeleted $event)
    {

        $model = $event->getModel();
        if(!($model instanceof PaypalWebProfile)){
            return;
        }

        $this->webProfileClient->delete($model->code);

    }
}
