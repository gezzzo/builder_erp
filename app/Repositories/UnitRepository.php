<?php

namespace App\Repositories;

use App\Http\Traits\FilesTrait;
use App\Models\Unit;
use App\Repositories\Interfaces\UnitInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UnitRepository implements UnitInterface
{
    use FilesTrait;

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Unit::query()->with(['building', 'grantee', 'client'])->get();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $unit = Unit::query()->create($data);
        $unit->unit_deed = $this->binaryImageUpload($data['unit_deed'], 'unit_deed', 'images/units');
        $unit->construction_license = $this->binaryImageUpload($data['construction_license'], 'construction_license', 'images/units');
        $unit->sorting_report = $this->binaryImageUpload($data['sorting_report'], 'sorting_report', 'images/units');
        $unit->architectural_plan = $this->binaryImageUpload($data['architectural_plan'], 'architectural_plan', 'images/units');
        $unit->architectural_plan_pdf = $this->binaryImageUpload($data['architectural_plan_pdf'], 'architectural_plan_pdf', 'images/units');
        $unit->chart = $this->binaryImageUpload($data['chart'], 'chart', 'images/units');
        $unit->structural_plan = $this->binaryImageUpload($data['structural_plan'], 'structural_plan', 'images/units');
        $unit->parking_plan = $this->binaryImageUpload($data['parking_chart'], 'parking_chart', 'images/units');
        $unit->save();
        return $unit;
    }

    /**
     * @param array $data
     * @param $id
     * @return Model
     */
    public function update(array $data, $id): Model
    {
        $unit = Unit::query()->find($id);
        $unit->update($data);
        if (isset($data['unit_deed'])) {
            $unit->unit_deed = $this->binaryImageUpload($data['unit_deed'], 'unit_deed', 'images/units');
        }
        if (isset($data['construction_license'])) {
            $unit->construction_license = $this->binaryImageUpload($data['construction_license'], 'construction_license', 'images/units');
        }
        if (isset($data['sorting_report'])) {
            $unit->sorting_report = $this->binaryImageUpload($data['sorting_report'], 'sorting_report', 'images/units');
        }
        if (isset($data['architectural_plan'])) {
            $unit->architectural_plan = $this->binaryImageUpload($data['architectural_plan'], 'architectural_plan', 'images/units');
        }
        if (isset($data['architectural_plan_pdf'])) {
            $unit->architectural_plan_pdf = $this->binaryImageUpload($data['architectural_plan_pdf'], 'architectural_plan_pdf', 'images/units');
        }
        if (isset($data['chart'])) {
            $unit->chart = $this->binaryImageUpload($data['chart'], 'chart', 'images/units');
        }
        if (isset($data['structural_plan'])) {
            $unit->structural_plan = $this->binaryImageUpload($data['structural_plan'], 'structural_plan', 'images/units');
        }
        if (isset($data['parking_chart'])) {
            $unit->parking_plan = $this->binaryImageUpload($data['parking_chart'], 'parking_chart', 'images/units');
        }
        $unit->save();
        return $unit;
    }

    /**
     * @param $id
     * @return string
     */
    public function delete($id): string
    {
        $unit = Unit::query()->find($id);
        $unit->delete();
        return 'Unit deleted successfully';
    }

    /**
     * @param $id
     * @return Model
     */
    public function show($id): Model
    {
        return Unit::query()->with(['building', 'grantee', 'client'])->find($id);
    }

    /**
     * @param array $filters
     * @return Builder[]|Collection
     */
    public function search(array $filters): Collection|array
    {
        $units = Unit::query();
        if (isset($filters['name'])) {
            $units->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (isset($filters['unit_number'])) {
            $units->where('unit_number', 'like', '%' . $filters['unit_number'] . '%');
        }
        if (isset($filters['floor'])) {
            $units->where('floor', 'like', '%' . $filters['floor'] . '%');
        }
        if (isset($filters['model'])) {
            $units->where('model', 'like', '%' . $filters['model'] . '%');
        }
        if (isset($filters['status'])) {
            $units->where('status', 'like', '%' . $filters['status'] . '%');
        }
        if (isset($filters['price'])) {
            $units->where('price', 'like', '%' . $filters['price'] . '%');
        }
        if (isset($filters['area'])) {
            $units->where('area', 'like', '%' . $filters['area'] . '%');
        }
        if (isset($filters['space_area'])) {
            $units->where('space_area', 'like', '%' . $filters['space_area'] . '%');
        }
        if (isset($filters['total_area'])) {
            $units->where('total_area', 'like', '%' . $filters['total_area'] . '%');
        }
        if (isset($filters['bedroom_main'])) {
            $units->where('bedroom_main', 'like', '%' . $filters['bedroom_main'] . '%');
        }
        if (isset($filters['bedroom'])) {
            $units->where('bedroom', 'like', '%' . $filters['bedroom'] . '%');
        }
        if (isset($filters['total_bedroom'])) {
            $units->where('total_bedroom', 'like', '%' . $filters['total_bedroom'] . '%');
        }
        if (isset($filters['bathroom'])) {
            $units->where('bathroom', 'like', '%' . $filters['bathroom'] . '%');
        }
        if (isset($filters['bathroom_inside'])) {
            $units->where('bathroom_inside', 'like', '%' . $filters['bathroom_inside'] .
                '%');
        }
        if (isset($filters['bathroom_guest'])) {
            $units->where('bathroom_guest', 'like', '%' . $filters['bathroom_guest'] . '%');
        }
        if (isset($filters['total_bathroom'])) {
            $units->where('total_bathroom', 'like', '%' . $filters['total_bathroom'] . '%');
        }
        if (isset($filters['living'])) {
            $units->where('living', 'like', '%' . $filters['living'] . '%');
        }
        if (isset($filters['divan'])) {
            $units->where('divan', 'like', '%' . $filters['divan'] . '%');
        }
        if (isset($filters['open_divan'])) {
            $units->where('open_divan', 'like', '%' . $filters['open_divan'] . '%');
        }
        if (isset($filters['dining_rooms'])) {
            $units->where('dining_rooms', 'like', '%' . $filters['dining_rooms'] . '%');
        }
        if (isset($filters['kitchen'])) {
            $units->where('kitchen', 'like', '%' . $filters['kitchen'] . '%');
        }
        if (isset($filters['kitchen_type'])) {
            $units->where('kitchen_type', 'like', '%' . $filters['kitchen_type'] . '%');
        }
        if (isset($filters['laundry_rooms'])) {
            $units->where('laundry_rooms', 'like', '%' . $filters['laundry_rooms'] . '%');
        }
        if (isset($filters['store_room'])) {
            $units->where('store_room', 'like', '%' . $filters['store_room'] . '%');
        }
        if (isset($filters['servant_room'])) {
            $units->where('servant_room', 'like', '%' . $filters['servant_room'] . '%');
        }
        if (isset($filters['park'])) {
            $units->where('park', 'like', '%' . $filters['park'] . '%');
        }
        if (isset($filters['balcony'])) {
            $units->where('balcony', 'like', '%' . $filters['balcony'] . '%');
        }
        if (isset($filters['terrace'])) {
            $units->where('terrace', 'like', '%' . $filters['terrace'] . '%');
        }
        if (isset($filters['private_entrance'])) {
            $units->where('private_entrance', 'like', '%' . $filters['private_entrance'] . '%');
        }
        if (isset($filters['havac'])) {
            $units->where('havac', 'like', '%' . $filters['havac'] . '%');
        }
        return $units->with(['building', 'grantee', 'client'])->get();
    }
}
