<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserSettingRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UsersController constructor.
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function updateSettings(UserSettingRequest $request)
    {
        $data = $request->only('password');
        $this->repository->update($data, $request->user('api')->id);

        return $request->user('api');
    }
}
