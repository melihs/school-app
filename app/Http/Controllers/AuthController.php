<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterRequest;
use App\Notifications\RegisterAccountNotification;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $data = $this->authRepository->register($request);

        if(!isset($data)) {
            return response()->json(['error' => 'not found'],404);
        }

        return new UserResource($data);
    }

    /**
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        return $this->authRepository->login($request);
    }

}
