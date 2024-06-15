<?php

namespace App\Http\Controllers\API\Dashboard\Tenants;

use App\Http\Controllers\API\BaseController;
use App\Repositories\Interfaces\CompanyInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{

    private CompanyInterface $companyRepository;

    public function __construct(CompanyInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->respondData($this->companyRepository->all(), 'Companies retrieved successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        return $this->respondData($this->companyRepository->create($data), 'Company created successfully.');
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->all();
        return $this->respondData($this->companyRepository->update($data, $id), 'Company updated successfully.');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return $this->respondData($this->companyRepository->delete($id), 'Company deleted successfully.');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->respondData($this->companyRepository->show($id), 'Company retrieved successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $filters = $request->all();
        return $this->respondData($this->companyRepository->search($filters), 'Companies retrieved successfully.');
    }
}
