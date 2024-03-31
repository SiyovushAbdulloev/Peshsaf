<?php

namespace App\Http\Requests\Warehouse\Utilization;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Warehouse\Utilization\UpdateRequestParams;

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
            'type'      => ['required', 'in:client,outlet'],
            'client_id' => ['nullable', 'required_if:type,client', 'exists:clients,id'],
            'outlet_id' => ['nullable', 'required_if:type,outlet', 'exists:outlets,id'],
            'number'    => ['required', 'string', 'max:255'],
            'date'      => ['required', 'string'],
        ];
    }

    public function toArray(): array
    {
        return [
            'type'     => $this->get('type'),
            'clientId' => $this->get('client_id'),
            'outletId' => $this->get('outlet_id'),
            'number'   => $this->get('number'),
            'date'     => $this->get('date'),
        ];
    }
}
