<?php


namespace App\Repositories;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function getDetailList(User $user)
    {

    }

    public function store($request)
    {

    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getByUser($id)
    {
        return User::where('id',$id)->get()->first();
    }

    public function update(User $user,$request)
    {

    }
    public function destroy(User $user)
    {

    }
}