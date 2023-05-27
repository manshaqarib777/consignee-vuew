<?php


namespace App\Services\App\Consignee;

use App\Models\App\Consignee\Consignee;
use App\Services\App\AppService;

class ConsigneeService extends AppService
{
    public function __construct(Consignee $crud)
    {
        $this->model = $crud;
    }

    /**
     * Get only name from Consignee model
     * @return \Illuminate\Support\Collection
     */
    public function getName()
    {
        return $this->model->select('name')->get();
    }

    /**
     * Update Consignee service
     * @param Consignee $crud
     * @return Consignee
     */
    public function update(Consignee $crud)
    {
        $crud->fill(request()->all());

        $this->model = $crud;

        $crud->save();

        return $crud;
    }

    /**
     * Delete Consignee service
     * @param Consignee $crud
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Consignee $crud)
    {
        return $crud->delete();
    }
}
