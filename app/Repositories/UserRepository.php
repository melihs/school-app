<?php


namespace App\Repositories;

use App\User;
use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @return mixed
     */
    public function index()
    {
        $students = User::where('status','student')->get();

        return $students;
    }

    /**
     * @param $code
     *
     * @return mixed
     */
    public function getParent($invite_code)
    {
        $parent = User::where('status','parent')
            ->where('code',$invite_code)
            ->first();
        return $parent;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        return auth()->user();
    }

    public function update(User $user,$request)
    {

    }

    public function destroy(User $user)
    {

    }
}