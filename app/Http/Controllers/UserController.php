<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\StudentResource;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    /**
     * UserController constructor.
     *
     * @param UserRepositoryInterface $user_repository
     */
    public function __construct(UserRepositoryInterface $user_repository)
    {
        $user = auth()->check();
        $this->userRepository = $user_repository;
    }

    /**
     * all users list
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return StudentResource::collection($this->userRepository->index());
    }

    /**
     * authenticate user info
     *
     * @return UserResource
     */
    public function show()
    {
        return new UserResource($this->userRepository->show());
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return UserResource
     */
    public function update(Request $request, $id)
    {
        return new UserResource($this->userRepository->update($request,$id));
    }
}
