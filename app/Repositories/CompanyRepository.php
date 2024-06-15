<?php

namespace App\Repositories;

use App\Http\Traits\FilesTrait;
use App\Models\Company;
use App\Repositories\Interfaces\CompanyInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository implements CompanyInterface
{
    use FilesTrait;

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Company::all();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $client = new Company();
        $client->fill($data);
        $client->save();
        return $client;
    }

    /**
     * @param array $data
     * @param $id
     * @return Model
     */
    public function update(array $data, $id): Model
    {
        $client = Company::query()->find($id);
        $client->fill($data);

        $client->save();
        return $client;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        return Company::destroy($id);
    }

    /**
     * @param $id
     * @return Model
     */
    public function show($id): Model
    {
        return Company::query()->find($id);
    }

    /**
     * @param array $filters
     * @return Builder
     */
    public function search(array $filters): Builder
    {
        $query = Company::query();
        if (isset($filters['company_name'])) {
            $query->where('company_name', 'like', '%' . $filters['company_name'] . '%');
        }
        return $query;
    }
}
