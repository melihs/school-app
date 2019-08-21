<?php


namespace App\Repositories\Interfaces;
use App\User;

interface UserRepositoryInterface
{
    public function getDetailList(User $user);
    public function store($request);
    public function getByUser($id);
    public function update(User $user, $request);
    public function destroy(User $user);
}