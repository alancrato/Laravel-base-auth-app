<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Video;

/**
 * Class VideoTransformer
 * @package namespace App\Transformers;
 */
class VideoTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'series',
        'series_title',
        'categories',
        'categories_name'
    ];

    /**
     * Transform the Video entity
     * @param Video $model
     *
     * @return array
     */
    public function transform(Video $model)
    {
        return [
            'id' => (int) $model->id,
            'title' => $model->title,
            'description' => $model->description,
            'thumb_small_url' => $model->thumb_small_asset,
            'file_url' => $model->file_asset,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeSerie(Video $model)
    {
        if(!$model->serie){
            return null;
        }
        return $this->item($model->serie, new SerieTransformer());
    }

    public function includeSerieTitle(Video $model)
    {
        if(!$model->serie){
            return null;
        }
        return $this->item($model->serie, new SerieTitleTransformer());
    }

    public function includeCategories(Video $model)
    {
        return $this->collection($model->categories(), new CategoryTransformer());
    }

    public function includeCategoriesName(Video $model)
    {
        return $this->item($model->categories, new CategoryNameTransformer());
    }
}
