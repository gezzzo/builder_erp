<?php

namespace App\Repositories;

use App\Http\Resources\API\Dashboard\UserResource;
use App\Http\Traits\FilesTrait;
use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserRepository implements UserInterface
{
    use FilesTrait;

    /**
     * @return Collection
     */
    public function allUsers(): Collection
    {
        return User::with('role')->get();
    }

    /**
     * @param $request
     * @return AnonymousResourceCollection
     */
    public function create($request): AnonymousResourceCollection
    {
        $per_page = $request->has('per_page') ? $request->per_page : 10;
        $users = User::query()->filter(request()->all())->orderBy('updated_at', 'desc');
        $users = $users->paginate($per_page);
        return UserResource::collection($users);
    }

    /**
     * @param $request
     * @param $userId
     * @return string
     */
    public function update($request, $userId): string
    {
        $user = User::query()->find($userId);
        $user->update($request->all());
        return 'success';
    }

    /**
     * @param $userId
     * @return string
     */
    public function destroy($userId): string
    {
        /** @var User $user */
        User::query()->find($userId)->delete();
        return 'User Deleted Successfully!';
    }

    /**
     * @param $userId
     * @return User
     */
    public function findById($userId): User
    {
        /** @var User $user */
        $user = User::query()->where('id', $userId)->with('role')->first();
        return $user;
    }

    /**
     * @param $userEmail
     * @return User
     */
    public function findByEmail($userEmail): User
    {
        /** @var User $user */
        $user = User::query()->where('email', $userEmail)->with('role')->first();
        return $user;
    }
}
