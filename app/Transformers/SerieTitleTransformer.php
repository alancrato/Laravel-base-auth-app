<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Serie;

/**
 * Class SerieTitleTransformer
 * @package namespace App\Transformers;
 */
class SerieTitleTransformer extends TransformerAbstract
{

    /**
     * Transform the \SerieTitle entity
     * @param \SerieTitle $model
     *
     * @return array
     */
    public function transform(Serie $model)
    {
        return [
            'id' => (int) $model->id,
            /* place your other model properties here */
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
