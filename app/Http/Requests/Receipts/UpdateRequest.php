<?php

namespace App\Http\Requests\Receipts;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Warehouse\Receipt\UpdateRequestParams;

class UpdateRequest extends CoreFormRequest
{
    protected string $params = UpdateRequestParams::class;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'number'      => ['required', 'string', 'max:255'],
            'date'        => ['required', 'string'],
            'products'    => ['required', 'array', 'min:1'],
            'products.*'  => ['required', 'int', 'min:1'],
            'paper_size'  => ['required', 'string', 'in:A3,A4'],
        ];
    }

    public function toArray(): array
    {
        return [
            'supplierId' => $this->get('supplier_id'),
            'number'     => $this->get('number'),
            'date'       => $this->get('date'),
            'products'   => $this->get('products'),
            'paperSize'  => $this->get('paper_size'),
        ];
    }
}
