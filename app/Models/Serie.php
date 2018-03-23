<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Serie extends Model implements Transformable, TableInterface
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
