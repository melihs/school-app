<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\ParentResource;
use App\Http\Resources\UserCollection;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $user = auth()->check();
        $this->userRepository = $userRepository;
    }

    public function index()
    {
//        return UserResource::collection($this->userRepository->getListParentAndStudents());
        return UserResource::collection($this->userRepository->index());
    }

    /**
     * @param $code
     *
     * @return FamilyResource|\Illuminate\Http\JsonResponse
     */
    public function getParent($code)
    {
        $data = $this->userRepository->getParent($code);

        if(!isset($data)) {
            return response()->json(['error' => 'not found'],404);
        }
        return new ParentResource($data);
    }

    /**
     * @return UserResource
     */
    public function me()
    {
        return new UserResource($this->userRepository->show());
    }
}
