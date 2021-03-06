<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use App\Media\VideoPaths;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Video extends Model implements Transformable, TableInterface
{
    use TransformableTrait;
    use VideoPaths;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'published',
        'serie_id'
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return['#'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#';
                return $this->id;
                break;
        }
    }
}
