<?php

namespace App\Http\Requests\Substance;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Substance\StoreRequestParams;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:substances,name'],
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->get('name'),
        ];
    }
}

