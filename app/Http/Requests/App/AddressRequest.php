<?php

namespace App\Http\Requests\App;

use App\Models\App\Address\Address;

class AddressRequest extends AppRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws \App\Exceptions\GeneralException
     */
    public function rules()
    {
        return $this->initRules(new Address());
    }
}
