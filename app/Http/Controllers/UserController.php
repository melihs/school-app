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
//        return UserResource::collection($this->userRepository->getListParentAndStudents());
        $st = Student::with('parent')->get();
       return $st;
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
