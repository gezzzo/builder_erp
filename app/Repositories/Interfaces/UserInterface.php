<?php

namespace App\Repositories\Interfaces;

interface UserInterface
{
    public function allUsers();

    public function create($request);

    public function update($request, $userId);

    public function destroy($userId);

    public function findById($userId);

    public function findByEmail($userEmail);
}
