<?php


namespace App\Services\App\Address;

use App\Models\App\Address\Address;
use App\Services\App\AppService;

class AddressService extends AppService
{
    public function __construct(Address $address)
    {
        $this->model = $address;
    }

    /**
     * Get only name from Address model
     * @return \Illuminate\Support\Collection
     */
    public function getName()
    {
        return $this->model->select('name')->get();
    }

    /**
     * Update Address service
     * @param Address $address
     * @return Address
     */
    public function update(Address $address)
    {
        $address->fill(request()->all());

        $this->model = $address;

        $address->save();

        return $address;
    }

    /**
     * Delete Address service
     * @param Address $address
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Address $address)
    {
        return $address->delete();
    }
}
