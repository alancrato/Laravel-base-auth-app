<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Bootstrapper\Interfaces\TableInterface;

class Category extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'description',
        'url'
    ];

    public function getTableHeaders()
    {
        return ['#', 'Nome', 'Description', 'Url'];
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
            case 'Url':
                return $this->url;
        }
    }
}
