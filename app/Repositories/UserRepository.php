<?php


namespace App\Repositories;

use App\Student;
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
        $students = Student::with('parent')->get();

        return $students;
    }

    /**
     * @return mixed
     */
    public function show()
    {
        $parent = User::find(auth()->user()->id);
        $getRelateds = $parent->students->toArray();

        return $parent;
    }

    public function update(User $user,$request)
    {

    }

    public function destroy(User $user)
    {

    }
}