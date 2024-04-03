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
        $rules = [
            'name'       => ['required', 'string', 'max:255'],
            'position'   => ['required', 'integer', 'exists:positions,id'],
            'address'    => ['required', 'string', 'max:255'],
            'is_limited' => ['required', 'in:0,1'],
            'expired'    => ['nullable', 'required_if:is_limited,true', 'date'],
            'phone'      => ['required', 'regex:/^[0-9]{9}+$/'],
            'email'      => ['required', 'email'],
            'password'   => ['nullable', 'string', 'min:8', 'max:255'],
            'files'      => ['nullable', 'array'],
            'files.*'    => ['required_with:files', 'file', 'mimes:pdf,doc', 'max:5120'],
        ];

        return match ($this->user->role->name) {
            Role::VENDOR => array_merge($rules, ['outlet' => ['required', 'integer', 'exists:outlets,id']]),
            Role::WAREHOUSE => array_merge($rules, ['warehouse' => ['required', 'integer', 'exists:warehouses,id']]),
            default => $rules,
        };
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->get('name'),
            'positionId'  => $this->get('position'),
            'address'     => $this->get('address'),
            'isLimited'   => $this->boolean('is_limited'),
            'expired'     => $this->get('expired'),
            'warehouseId' => $this->get('warehouse'),
            'outletId'    => $this->get('outlet'),
            'phone'       => $this->get('phone'),
            'email'       => $this->get('email'),
            'password'    => $this->get('password'),
            'files'       => $this->file('files'),
        ];
    }
}

