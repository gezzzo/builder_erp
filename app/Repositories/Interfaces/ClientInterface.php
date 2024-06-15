<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\Tenants\StoreClientRequest;

interface ClientInterface
{
    public function index();
    public function create(StoreClientRequest $request);

    public function update($request, $userId);

    public function destroy($userId);

    public function findById($userId);

    public function findByEmail($userEmail);

    public function show($userId);

    public function search(array $filters);

}
