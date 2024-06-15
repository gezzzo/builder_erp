<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\API\BaseController;
use App\Models\User;
use App\Repositories\Interfaces\UserInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    private UserInterface $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->respondData($this->userInterface->allUsers());
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->respondData($this->userInterface->findById($id));
    }

    /**
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email',
        ]);

        $user = User::find($id)->update($request->all());

        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        return $this->respondData($user, 'User updated successfully');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->respondData($this->userInterface->destroy($id), 'User deleted successfully');
    }
}
