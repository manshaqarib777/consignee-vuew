<?php

namespace App\Models\App\Address;

use App\Models\App\AppModel;
use App\Models\App\Country\Country;
use App\Models\App\Consignee\Consignee;
use App\Models\App\Traits\AddressValidationRules;
use App\Models\Core\Auth\Traits\Boot\AddressBootTrait;

class Address extends AppModel
{
    use AddressValidationRules,AddressBootTrait;

    protected $fillable = ['name', 'address', 'city', 'state', 'zip_code', 'consignee_id', 'country_id'];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function consignee()
    {
        return $this->belongsTo(Consignee::class);
    }
}
