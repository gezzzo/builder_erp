<?php

namespace App\Repositories;

use App\Http\Traits\FilesTrait;
use App\Models\Project;
use App\Repositories\Interfaces\ProjectInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository implements ProjectInterface
{
    use FilesTrait;

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Project::query()->with('grantee')->get();
    }

    /**
     * @param array $data
     * @return Project
     */
    public function create(array $data): Project
    {
        $project = new Project();
        return $this->projectInputs($data, $project);
    }

    /**
     * @param array $data
     * @param $id
     * @return Project
     */
    public function update(array $data, $id): Project
    {
        $project = Project::find($id);
        return $this->projectInputs($data, $project);
    }

    /**
     * @param $id
     * @return string
     */
    public function delete($id): string
    {
        $project = Project::query()->findOrFail($id);
        $project->delete();
        return 'Project deleted successfully';
    }

    /**
     * @param $id
     * @return Model
     */
    public function show($id): Model
    {
        return Project::query()->findOrFail($id)->with('grantee')->first();
    }

    /**
     * @param array $filters
     * @return Collection
     */
    public function search(array $filters): Collection
    {
        return Project::query()->where('name_ar', 'like', '%' . $filters['name_ar'] . '%')
            ->orWhere('name_en', 'like', '%' . $filters['name_en'] . '%')
            ->orWhere('building_style', 'like', '%' . $filters['building_style'] . '%')
            ->orWhere('project_number', 'like', '%' . $filters['project_number'] . '%')
            ->orWhere('cities', 'like', '%' . $filters['cities'] . '%')
            ->orWhere('neighborhood', 'like', '%' . $filters['neighborhood'] . '%')
            ->orWhere('type', 'like', '%' . $filters['type'] . '%')
            ->orWhere('status', 'like', '%' . $filters['status'] . '%')
            ->orWhere('units_number', 'like', '%' . $filters['units_number'] . '%')
            ->orWhere('payment_options', 'like', '%' . $filters['payment_options'] . '%')
            ->orWhere('delivery_time', 'like', '%' . $filters['delivery_time'] . '%')
            ->orWhere('is_visible_employee', 'like', '%' . $filters['is_visible_employee'] . '%')
            ->orWhere('address_map', 'like', '%' . $filters['address_map'] . '%')
            ->orWhere('address_input', 'like', '%' . $filters['address_input'] . '%')
            ->orWhere('description', 'like', '%' . $filters['description'] . '%')
            ->orWhere('features', 'like', '%' . $filters['features'] . '%')
            ->orWhere('services', 'like', '%' . $filters['services'] . '%')
            ->orWhere('after_sales', 'like', '%' . $filters['after_sales'] . '%')
            ->orWhere('optional_service', 'like', '%' . $filters['optional_service'] . '%')
            ->orWhere('is_deleted', 'like', '%' . $filters['is_deleted'] . '%')
            ->orWhere('grantee_id', 'like', '%' . $filters['grantee_id'] . '%')
            ->get();
    }

    /**
     * @param array $data
     * @param Project $project
     * @return Project
     */
    public function projectInputs(array $data, Project $project): Project
    {
        $project->name_ar = $data['name_ar'];
        $project->name_en = $data['name_en'];
        $project->building_style = $data['building_style'];
        $project->project_number = $data['project_number'];
        $project->cities = $data['cities'];
        $project->neighborhood = $data['neighborhood'];
        $project->type = $data['type'];
        $project->status = $data['status'];
        $project->units_number = $data['units_number'];
        $project->payment_options = $data['payment_options'];
        $project->delivery_time = $data['delivery_time'];
        $project->is_visible_employee = $data['is_visible_employee'];
        $project->address_map = $data['address_map'];
        $project->address_input = $data['address_input'];
        $project->attachment = $this->binaryImageUpload($data['attachment'], 'projects', 'images/projects');
        $project->description = $data['description'];
        $project->features = $data['features'];
        $project->services = $data['services'];
        $project->after_sales = $data['after_sales'];
        $project->optional_service = $data['optional_service'];
        $project->project_instrument = $this->binaryImageUpload($data['project_instrument'], 'projects', 'images/projects');
        $project->project_building_permit = $this->binaryImageUpload($data['project_building_permit'], 'projects', 'images/projects');
        $project->construction_completion_certificate = $this->binaryImageUpload($data['construction_completion_certificate'], 'projects', 'images/projects');
        $project->electricity_connection_certificate = $this->binaryImageUpload($data['electricity_connection_certificate'], 'projects', 'images/projects');
        $project->is_deleted = $data['is_deleted'];
        $project->grantee_id = $data['grantee_id'];
        $project->save();
        return $project;
    }
}
