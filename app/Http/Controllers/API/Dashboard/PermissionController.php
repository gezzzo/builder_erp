<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\API\BaseController;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $permissions = Permission::all();
        return $this->respondData($permissions, 'Permissions retrieved successfully');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
        ]);

        $permission = Permission::create($request->all());

        if ($permission->errors())
            return $this->respondError($permission->errors(),'Permission not created');
        else
            return $this->respondData($permission, 'Permission created successfully');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $permission = Permission::find($id);
        return $this->respondData($permission, 'Permission retrieved successfully');
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $permission = Permission::find($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($request->all());

        if ($permission->errors())
            return $this->respondError($permission,'Permission not updated');
        else
            return $this->respondData($permission, 'Permission updated successfully');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        Permission::find($id)->delete();

        return $this->respondData([], 'Permission deleted successfully');
    }
}

