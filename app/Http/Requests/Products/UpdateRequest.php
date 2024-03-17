<?php

namespace App\Http\Requests\Products;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Product\UpdateRequestParams;
use Illuminate\Validation\Rule;

class UpdateRequest extends CoreFormRequest
{
    protected string $params = UpdateRequestParams::class;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'active_ingredient' => ['required', 'integer', 'exists:active_ingredients,id'],
            'status' => ['required', 'string', Rule::in($this->getList())],
            'measure' => ['required', 'integer', 'exists:measures,id'],
            'expiry_date' => ['required', 'string', 'date_format:d-m-Y'],
            'country' => ['required', 'integer', 'exists:countries,id'],
            'barcode' => ['required', 'string', 'max_digits:20'],
            'description' => ['required', 'string', 'max:500'],
            'files' => ['nullable', 'array'],
            'files.*' => ['required_with:files', 'file', 'mimes:pdf,doc', 'max:5120'],
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->get('name'),
            'activeIngredientId' => $this->get('active_ingredient'),
            'status' => $this->get('status'),
            'measureId' => $this->get('measure'),
            'expireDate' => $this->get('expiry_date'),
            'countryId' => $this->get('country'),
            'barcode' => $this->get('barcode'),
            'description' => $this->get('description'),
            'files' => $this->file('files'),
        ];
    }

    private function getList(): array
    {
        $list = [];
        foreach (config('project.list') as $item) {
            $list[] = $item['alias'];
        }

        return $list;
    }
}

