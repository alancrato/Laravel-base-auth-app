<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;
use App\Models\Category;

/**
 * Class CategoryNameTransformer
 * @package namespace App\Transformers;
 */
class CategoryNameTransformer extends TransformerAbstract
{
    /**
     * Transform the \CategoryName entity
     * @param \CategoryName $model
     *
     * @return array
     */
    public function transform(Collection $model)
    {
        return [
            'id' => $model->pluck('name')
        ];
    }
}
