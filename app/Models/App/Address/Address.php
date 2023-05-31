<?php

namespace App\Models\App\Address;

use App\Models\App\AppModel;
use App\Models\App\Country\Country;
use App\Models\App\Traits\AddressValidationRules;

class Address extends AppModel
{
    use AddressValidationRules;

    protected $fillable = ['name', 'address', 'city', 'state', 'zip_code', 'consignee_id', 'country_id'];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
