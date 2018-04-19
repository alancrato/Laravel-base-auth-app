<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Two\User;

class RegisterUsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * RegisterUsersController constructor.
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        $authorization = $request->header('Authorization');
        $accessToken = str_replace('Bearer ', '', $authorization);
        $facebook = \Socialite::driver('facebook');

        /** @var User $userSocial */
        $userSocial = $facebook->userFromToken($accessToken);
        dd($userSocial);
    }

}
