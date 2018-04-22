<?php

namespace App\Models;

use App\Notifications\DefaultResetPasswordNotification;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements TableInterface, JWTSubject
{
    const ROLE_ADMIN = 1;
    const ROLE_CLIENT = 2;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subscriptions()
    {
        return $this->hasManyThrough(Subscription::class,Order::class);
    }

    /**
     * @return bool
     */
    public function hasSubscriptionValid()
    {
        $valid = false;
        $subscriptions = $this->subscriptions;
        /** @var Subscription $subscription */
        foreach ($subscriptions as $subscription){
            if(!$subscription->isExpired()){
                $valid = true;
                break;
            }
        }
        return $valid;
    }

    public static function generatePassword($password = null)
    {
        return !$password? bcrypt(str_random(8)):bcrypt($password);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DefaultResetPasswordNotification($token));
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return [ '#', 'Nome', 'E-mail' ];
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
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'E-mail':
                return $this->email;
        }

    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->id;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
          'user' => [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
          ]
        ];
    }
}
