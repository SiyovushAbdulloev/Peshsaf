<?php

namespace App\Http\Requests\User;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\User\UpdateRequestParams;
use App\Models\Role;

class UpdateRequest extends CoreFormRequest
{
    protected string $params = UpdateRequestParams::class;

    public function rules(): array
    {
        $rule = [];
        if (auth()->user()->role->name === Role::VENDOR) {
            $rule = ['outlet' => ['required', 'integer', 'exists:outlets,id']];
        } else if (auth()->user()->role->name === Role::WAREHOUSE) {
            $rule = ['warehouse' => ['required', 'integer', 'exists:warehouses,id']];
        }

        //TODO: Add russian error messages here and provider
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'max:255'],
            'position' => ['required', 'integer', 'exists:positions,id'],
            ...$rule,
            'email' => ['required', 'email'],
            'phone' => ['required', 'regex:/^[0-9]{9}+$/'],
            'is_limited' => ['required', 'boolean'],
            'expired' => ['required', 'string'],
            'files' => ['nullable', 'array'],
            'files.*' => ['required_with:files', 'file', 'mimes:pdf,doc', 'max:5120'],
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->get('name'),
            'address' => $this->get('address'),
            'positionId' => $this->get('position'),
            'warehouseId' => $this->get('warehouse'),
            'outletId' => $this->get('outlet'),
            'email' => $this->get('email'),
            'phone' => $this->get('phone'),
            'isLimited' => $this->boolean('is_limited'),
            'expired' => $this->get('expired'),
            'password' => $this->get('password'),
            'files' => $this->file('files'),
        ];
    }
}

