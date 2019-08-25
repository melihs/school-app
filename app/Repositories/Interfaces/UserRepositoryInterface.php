<?php


namespace App\Repositories\Interfaces;

use App\User;

interface UserRepositoryInterface
{
    public function index();
    public function show();
    public function update(User $user, $request);
    public function destroy(User $user);
}