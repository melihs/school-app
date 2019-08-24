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
    public function family($code)
    {
        $family = User::where('status','family')
            ->where('code',$code)
            ->first();

        return $family;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        return auth()->user();
    }

    public function getStudent()
    {

    }

    public function update(User $user,$request)
    {

    }

    public function destroy(User $user)
    {

    }
}