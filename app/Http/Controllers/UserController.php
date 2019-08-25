<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\StudentResource;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $user_repository)
    {
        $user = auth()->check();
        $this->userRepository = $user_repository;
    }

    public function index()
    {
        return StudentResource::collection($this->userRepository->index());
    }

    /**
     * @return UserResource
     */
    public function show()
    {
        return new UserResource($this->userRepository->show());
    }
}
