<?php

namespace App\Http\Controllers\API\Dashboard\Tenants;

use App\Http\Controllers\API\BaseController;
use App\Repositories\Interfaces\UnitInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnitController extends BaseController
{
    private UnitInterface $unitRepository;

    public function __construct(UnitInterface $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $units = $this->unitRepository->all();
        return $this->respondData($units, 'Units retrieved successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $unit = $this->unitRepository->create($request->all());
        return $this->respondData($unit, 'Unit created successfully.');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $unit = $this->unitRepository->show($id);
        return $this->respondData($unit, 'Unit retrieved successfully.');
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $unit = $this->unitRepository->update($request->all(), $id);
        return $this->respondData($unit, 'Unit updated successfully.');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->unitRepository->delete($id);
        return $this->respondData('Unit deleted successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $units = $this->unitRepository->search($request->all());
        return $this->respondData($units, 'Units retrieved successfully.');
    }
}
