<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Serie;

/**
 * Class SerieTransformer
 * @package namespace App\Transformers;
 */
class SerieTransformer extends TransformerAbstract
{

    /**
     * Transform the \Serie entity
     * @param \Serie $model
     *
     * @return array
     */
    public function transform(Serie $model)
    {
        return [
            'title' => $model->title,
        ];
    }
}
