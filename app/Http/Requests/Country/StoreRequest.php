<?php

namespace App\Http\Requests\Country;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Country\StoreRequestParams;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:countries,name'],
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->get('name'),
        ];
    }
}

