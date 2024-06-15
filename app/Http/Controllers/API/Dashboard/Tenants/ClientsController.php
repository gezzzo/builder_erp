<?php

namespace App\Http\Controllers\API\Dashboard\Tenants;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Tenants\StoreClientRequest;
use App\Repositories\Interfaces\ClientInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientsController extends BaseController
{
    private ClientInterface $clientRepository;

    public function __construct(ClientInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->respondData($this->clientRepository->index());
    }

    /**
     * @param StoreClientRequest $request
     * @return JsonResponse
     */
    public function store(StoreClientRequest $request): JsonResponse
    {
        $client = $this->clientRepository->create($request->validated());
        return $this->respondData($client, 'Client created successfully', 201);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $client = $this->clientRepository->show($id);
        return $this->respondData($client);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->all();
        $client = $this->clientRepository->update($data, $id);
        return $this->respondData($client, 'Client updated successfully');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $this->clientRepository->destroy($id);
        return $this->respondData('Client deleted successfully');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $filters = $request->all();
        $clients = $this->clientRepository->search($filters);
        return $this->respondData($clients);
    }
}
