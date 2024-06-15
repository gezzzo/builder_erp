<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\API\BaseController;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $roles = Role::with('permission')->get();
        return $this->respondData($roles, 'Roles retrieved successfully');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        $role = Role::create($request->all());
        if ($role->errors())
            return $this->respondError($role->errors(), 'Role not created');
        else
            return $this->respondData($role, 'Role created successfully');

    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $role = Role::find($id)->load('permission');
        return $this->respondData($role, 'Role retrieved successfully');
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $role = Role::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role->update($request->all());

        if ($role->errors())
            return $this->respondError($role->error, 'Role not updated');
        else
            return $this->respondData($role, 'Role updated successfully');


    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        Role::find($id)->delete();

        return $this->respondData([], 'Role deleted successfully');
    }
}
