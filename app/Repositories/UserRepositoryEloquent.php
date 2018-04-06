<?php

namespace App\Repositories;

use App\Models\User;
use Jrean\UserVerification\Facades\UserVerification;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{

    public function create(array $attributes)
    {
        $attributes['role'] = User::ROLE_CLIENT;
        $attributes['password'] = User::generatePassword();
        $model = parent::create($attributes);
        UserVerification::generate($model);
        UserVerification::send($model,'Sua conta foi criada!');
        return $model;
    }

    public function update(array $attributes, $id)
    {
        if(isset($attributes['password'])){
            $attributes['password'] = User::generatePassword($attributes['password']);
        }
        $model = parent::update($attributes,$id);
        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
