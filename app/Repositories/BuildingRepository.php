<?php

namespace App\Repositories;

use App\Http\Traits\FilesTrait;
use App\Models\Building;
use App\Repositories\Interfaces\BuildingInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BuildingRepository implements BuildingInterface
{
    use FilesTrait;


    /**
     * @return Collection|array
     */
    public function all(): Collection|array
    {
        return Building::query()->with(['project','units'])->get();
    }

    /**
     * @param array $data
     * @return Building
     */
    public function create(array $data): Building
    {
        $building = new Building();
        $building->fill($data);
        $building->attachment = $this->binaryImageUpload($data['attachment'],'attachment','images/buildings');
        $building->save();
        return $building;
    }

    /**
     * @param array $data
     * @param $id
     * @return Model
     */
    public function update(array $data, $id): Model
    {
        $building = Building::query()->find($id);
        $building->fill($data);
        if (isset($data['attachment'])) {
            $building->attachment = $this->binaryImageUpload($data['attachment'],'attachment','images/buildings');
        }
        $building->save();
        return $building;
    }

    public function delete($id): string
    {
        $building = Building::query()->find($id);
        $building->delete();
        return 'Building deleted successfully';
    }

    /**
     * @param $id
     * @return Model
     */
    public function show($id): Model
    {
        return Building::query()->with(['project','units'])->find($id);
    }

    /**
     * @param $data
     * @return Builder[]|Collection
     */
    public function search($data): Collection|array
    {
        $query = Building::query();
        if (isset($data['building_number'])) {
            $query->where('building_number', 'like', '%' . $data['building_number'] . '%');
        }
        if (isset($data['building_name'])) {
            $query->where('building_name', 'like', '%' . $data['building_name'] . '%');
        }
        if (isset($data['project_id'])) {
            $query->where('project_id', $data['project_id']);
        }
        return $query->get();
    }
}
