<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\ParentResource;
use App\Http\Resources\UserCollection;
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
        return UserResource::collection($this->userRepository->index());
    }

    /**
     * @return UserResource
     */
    public function show()
    {
        return new UserResource($this->userRepository->show());
    }
}
