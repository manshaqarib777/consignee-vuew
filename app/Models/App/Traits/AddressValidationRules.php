<?php


namespace App\Models\App\Traits;


trait AddressValidationRules
{
    public function createdRules()
    {
        return [
            'name' => 'required|min:2|max:195',
            'address' => 'nullable|max:500',
            'city' => 'required|min:2|max:195',
            'state' => 'required|min:2|max:195',
            'zip_code' => 'required|min:2|max:195',
            'consignee_id' => 'required|exists:consignees,id',
            'country_id' => 'required|exists:countries,id',

        ];
    }

    public function updatedRules()
    {
        return [
            'name' => 'required|min:2|max:195',
            'email' => 'required|email',
            'status' => 'nullable|in:active,inactive,invited',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|numeric|max:120'
        ];
    }
}