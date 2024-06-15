<?php

namespace App\Http\Controllers\API\Dashboard\Tenants;

use App\Http\Controllers\API\BaseController;
use App\Repositories\Interfaces\BuildingInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BuildingController extends BaseController
{
    private BuildingInterface $buildingRepository;

    public function __construct(BuildingInterface $buildingRepository)
    {
        $this->buildingRepository = $buildingRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->respondData($this->buildingRepository->all());
    }

    public function store(Request $request): JsonResponse
    {
        return $this->respondData($this->buildingRepository->create($request->all()));
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        return $this->respondData($this->buildingRepository->update($request->all(), $id));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->respondData($this->buildingRepository->delete($id));
    }

    public function show($id): JsonResponse
    {
        return $this->respondData($this->buildingRepository->show($id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        return $this->respondData($this->buildingRepository->search($request->all()));
    }


}
