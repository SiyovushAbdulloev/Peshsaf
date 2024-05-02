<?php

namespace App\Http\Requests\Country;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Country\StoreRequestParams;
use Illuminate\Validation\Rule;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        return [
            'name'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('countries', 'name')->ignore($this->country?->id),
            ],
            'is_favorite' => ['sometimes', 'boolean'],
        ];
    }

    public function toArray(): array
    {
        return [
            'name'       => $this->get('name'),
            'isFavorite' => $this->get('is_favorite') ?? false,
        ];
    }
}

