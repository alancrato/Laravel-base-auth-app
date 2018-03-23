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
        'embed'
    ];

    public function getTableHeaders()
    {
        return ['#', 'Nome', 'Description', 'Embed'];
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
            case 'Embed':
                return $this->embed;
        }
    }
}
