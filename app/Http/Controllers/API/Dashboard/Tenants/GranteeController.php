<?php

namespace App\Http\Controllers\API\Dashboard\Tenants;

use App\Http\Controllers\API\BaseController;
use App\Repositories\Interfaces\GranteeInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GranteeController extends BaseController
{

    private GranteeInterface $granteeRepository;

    public function __construct(GranteeInterface $granteeRepository)
    {
        $this->granteeRepository = $granteeRepository;
    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->respondData($this->granteeRepository->all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        return $this->respondData($this->granteeRepository->create($data), 'created');
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->all();
        return $this->respondData($this->granteeRepository->update($data, $id), 'updated');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->respondData($this->granteeRepository->delete($id), 'deleted');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->respondData($this->granteeRepository->find($id));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $data = $request->all();
        return $this->respondData($this->granteeRepository->search($data));
    }

}
