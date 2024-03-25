<?php

namespace App\Http\Requests\Return\Warehouse;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Return\Warehouse\UpdateRequestParams;

class UpdateRequest extends CoreFormRequest
{
    protected string $params = UpdateRequestParams::class;

    public function rules(): array
    {
        return [
            'date'   => ['required', 'string'],
            'number' => ['required', 'string'],
        ];
    }

    public function toArray(): array
    {
        return [
            'date'   => $this->get('date'),
            'number' => $this->get('number'),
        ];
    }
}

