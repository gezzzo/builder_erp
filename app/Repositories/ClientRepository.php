<?php

namespace App\Repositories;

use App\Http\Requests\Tenants\StoreClientRequest;
use App\Http\Traits\FilesTrait;
use App\Models\Client;
use App\Repositories\Interfaces\ClientInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ClientRepository implements ClientInterface
{
    use FilesTrait;

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return Client::all();
    }

    /**
     * @param StoreClientRequest $request
     * @return Builder|Model
     */
    public function create(StoreClientRequest $request): Model|Builder
    {
        $request->validated();
        $client = Client::query()->create($request->all());
        $client->update([
            'national_id' => $this->binaryImageUpload($request->file('national_id'), 'national_id', '/images/clients'),
            'national_address' => $this->binaryImageUpload($request->file('national_address'), 'national_address', '/images/clients'),
            'iban_certification' => $this->binaryImageUpload($request->file('iban_certification'), 'iban_certification', '/images/clients'),
        ]);
        $client->save();
        return Client::query()->create($request->all());
    }

    /**
     * @param $request
     * @param $userId
     * @return Collection
     */
    public function update($request, $userId): Collection
    {
        $client = $this->findById($userId);
        $client->update($request->all());
        return $client;
    }

    /**
     * @param $userId
     * @return string
     */
    public function destroy($userId): string
    {
        $client = Client::query()->find($userId);
        $client->delete();
        return 'Client deleted successfully.';
    }

    /**
     * @param $userId
     * @return Collection
     */
    public function findById($userId)
    {
        $client = Client::query()->find($userId);
        return $client;
    }

    /**
     * @param $userEmail
     * @return Builder
     */
    public function findByEmail($userEmail)
    {
        $client = Client::query()->where('email', $userEmail)->first();
        return $client;
    }

    /**
     * @param $userId
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function show($userId): Model|Collection|Builder|array|null
    {
        return Client::query()->find($userId);
    }

    /**
     * @param array $filters
     * @return Builder
     */

    public function search(array $filters): Builder
    {
        $query = Client::query();
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (isset($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }
        if (isset($filters['phone'])) {
            $query->where('phone', 'like', '%' . $filters['phone'] . '%');
        }
        if (isset($filters['national_id'])) {
            $query->where('national_id', 'like', '%' . $filters['national_id'] . '%');
        }
        if (isset($filters['national_address'])) {
            $query->where('national_address', 'like', '%' . $filters['national_address'] . '%');
        }
        if (isset($filters['iban_certification'])) {
            $query->where('iban_certification', 'like', '%' . $filters['iban_certification'] . '%');
        }
        return $query;
    }
}
