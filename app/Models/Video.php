<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Video extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'description',
        'content',
        'serie_id',
        'url'
    ];

    public function getTableHeaders()
    {
        return ['#', 'Nome', 'Description', 'Serie', 'Content', 'Url'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'Description':
                return $this->description;
            case 'Serie':
                return $this->serie->name;
            case 'Content':
                return $this->content;
            case 'Url':
                return $this->url;
        }
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

}
