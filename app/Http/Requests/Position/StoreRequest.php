<?php

namespace App\Http\Requests\Position;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Position\StoreRequestParams;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:positions,name'],
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->get('name'),
        ];
    }
}

