<?php

namespace App\Models\App\Consignee;

use App\Models\App\AppModel;
use App\Models\App\Traits\ConsigneeValidationRules;
use App\Models\Core\Auth\Traits\Boot\ConsigneeBootTrait;
use App\Models\Core\Auth\User;

class Consignee extends AppModel
{
    use ConsigneeValidationRules,ConsigneeBootTrait;

    protected $fillable = ['name', 'email', 'phone', 'gender', 'age', 'status','created_by'];
    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }
}
