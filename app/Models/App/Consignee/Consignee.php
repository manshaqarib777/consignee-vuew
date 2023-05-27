<?php

namespace App\Models\App\Consignee;

use App\Models\App\AppModel;
use App\Models\App\Traits\ConsigneeValidationRules;

class Consignee extends AppModel
{
    use ConsigneeValidationRules;

    protected $fillable = ['name', 'email', 'phone', 'gender', 'age', 'status'];
}
