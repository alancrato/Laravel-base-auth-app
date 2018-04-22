<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PaypalWebProfile extends Model implements Transformable, TableInterface
{
    use TransformableTrait;
    use SoftDeletes;

    protected $table = 'paypal_web_profiles';

    protected $fillable = [
        'name',
        'logo_url',
        'code'
    ];

    public function getTableHeaders()
    {
        return ['#', 'Nome', 'Logo Url'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'Logo Url':
                return \BootstrapImage::thumbnail($this->logo_url, 'thumbnail');
        }
    }

}
