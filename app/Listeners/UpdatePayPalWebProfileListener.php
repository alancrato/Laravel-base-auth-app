<?php

namespace App\Listeners;

use App\Models\PaypalWebProfile;
use App\PayPal\WebProfileClient;
use Prettus\Repository\Events\RepositoryEntityUpdated;

class UpdatePayPalWebProfileListener
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
     * @param  RepositoryEntityUpdated  $event
     * @return void
     */
    public function handle(RepositoryEntityUpdated $event)
    {

        $model = $event->getModel();
        if(!($model instanceof PaypalWebProfile)){
            return;
        }
        if(!\Config::get('webprofile_created')) {
           $this->webProfileClient->update($model);
        }
    }
}
