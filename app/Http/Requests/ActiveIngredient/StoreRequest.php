<?php

namespace App\Http\Requests\ActiveIngredient;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\ActiveIngredient\StoreRequestParams;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:active_ingredients,name'],
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->get('name'),
        ];
    }
}

