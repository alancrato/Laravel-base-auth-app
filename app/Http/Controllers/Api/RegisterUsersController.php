<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRegisterRequest;
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

    public function store(UserRegisterRequest $request)
    {
        $user = $request->get('type')!='2'?
            $this->storeFromFacebook($request):
            $this->storeCommon($request);
        return ['token' => \Auth::guard('api')->tokenById($user->id)];
    }

    protected function storeCommon(Request $request)
    {
        \App\Models\User::unguard();
        $user = $this->repository->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => \App\Models\User::ROLE_CLIENT,
            'verified' => true
        ]);
        $user = $this->repository->update([
            'password' => $request->get('password')
        ],$user->id);
        \App\Models\User::reguard();
        return $user;
    }

    protected function storeFromFacebook(Request $request)
    {
        $authorization = $request->header('Authorization');
        $accessToken = str_replace('Bearer ', '', $authorization);
        $facebook = \Socialite::driver('facebook');
        /**@var TYPE_NAME $userSocial**/
        $userSocial = $facebook->userFromToken($accessToken);
        $user = $this->repository->findByField('email', $userSocial)->first();
        if(!$user){
            \App\Models\User::unguard();
            $user = $this->repository->create([
                'name' => $userSocial->name,
                'email' => $userSocial->email,
                'role' => \App\Models\User::ROLE_CLIENT,
                'verified' => true
            ]);
            \App\Models\User::reguard();
        }
        return $user;
    }

}
