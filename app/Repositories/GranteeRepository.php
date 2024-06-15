<?php

namespace App\Repositories;

use App\Http\Traits\FilesTrait;
use App\Models\Company;
use App\Models\Grantee;
use App\Repositories\Interfaces\GranteeInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GranteeRepository implements GranteeInterface
{
    use FilesTrait;

    /**
     * @param array $columns
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection
    {
        return Grantee::all();
    }

    /**
     * @param array $data
     * @return Grantee
     */
    public function create(array $data): Grantee
    {
        $company = Company::query()->where('id', $data['company_id'])->first();
        $grantee = new Grantee();
        $this->GranteeData($data, $grantee);
        $grantee->company()->associate($company);
        $grantee->save();
        return $grantee;
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id): mixed
    {
        $grantee = Grantee::find($id);
        $this->GranteeData($data, $grantee);
        $grantee->save();
        return $grantee;
    }

    /**
     * @param $id
     * @return string
     */
    public function delete($id): string
    {
        $grantee = Grantee::query()->where('id', $id)->first();
        $grantee->delete();
        return 'deleted successfully';
    }

    /**
     * @param $id
     * @param array $columns
     * @return Model
     */
    public function find($id, array $columns = ['*']): Model
    {
        return Grantee::query()->where('id', $id)->first();
    }

    /**
     * @param array $filters
     * @return Builder
     */
    public function search(array $filters): Builder
    {
        $query = Grantee::query();
        if (isset($filters['name_ar'])) {
            $query->where('name_ar', 'like', '%' . $filters['name_ar'] . '%');
        }
        if (isset($filters['name_en'])) {
            $query->where('name_en', 'like', '%' . $filters['name_en'] . '%');
        }
        if (isset($filters['company_id'])) {
            $query->where('company_id', $filters['company_id']);
        }
        return $query;
    }

    /**
     * @param array $data
     * @param Grantee $grantee
     * @return void
     */
    public function GranteeData(array $data, Grantee $grantee): void
    {
        $grantee->name_ar = $data['name_ar'];
        $grantee->name_en = $data['name_en'];
        $grantee->icon = $this->binaryImageUpload($data['icon'], 'icon', 'images/icons/');
        $grantee->duration = $data['duration'];
        $grantee->main_color = $data['main_color'];
        $grantee->sub_color = $data['sub_color'];
        $grantee->group = $data['group'];
    }
}
