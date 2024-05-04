<?php

namespace App\Http\Requests\Category;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Category\StoreRequestParams;
use Illuminate\Validation\Rule;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($this->category?->id),
            ],
            'code' => [
                'required',
                'string',
                'max:3',
                Rule::unique('categories', 'code')->ignore($this->category?->id),
            ],
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->get('name'),
            'code' => $this->get('code'),
        ];
    }
}

