<?php


namespace App\Services\App\Consignee;

use App\Models\App\Consignee\Consignee;
use App\Services\App\AppService;

class ConsigneeService extends AppService
{
    public function __construct(Consignee $consignee)
    {
        $this->model = $consignee;
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
     * @param Consignee $consignee
     * @return Consignee
     */
    public function update(Consignee $consignee)
    {
        $consignee->fill(request()->all());

        $this->model = $consignee;

        $consignee->save();

        return $consignee;
    }

    /**
     * Delete Consignee service
     * @param Consignee $consignee
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Consignee $consignee)
    {
        return $consignee->delete();
    }
}
