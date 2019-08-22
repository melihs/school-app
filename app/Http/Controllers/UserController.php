<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $user = auth()->check();
        $this->userRepository = $userRepository;
    }

    /**
     * @param $id
     *
     * @return json data
     */
    public function show($id)
    {
        return new UserResource($this->userRepository->getByUser($id));
    }
}
