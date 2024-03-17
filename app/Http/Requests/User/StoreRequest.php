<?php

namespace App\Http\Requests\User;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\User\StoreRequestParams;
use App\Models\Role;
use Illuminate\Validation\Rule;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        //TODO: Add russian error messages here and provider
        return [
            'name'       => ['required', 'string', 'max:255'],
            'position'   => ['required', 'integer', 'exists:positions,id'],
            'address'    => ['required', 'string', 'max:255'],
            'is_limited' => ['required', 'bool'],
            'expired'    => ['nullable', 'required_if:is_limited,true', 'date'],
            'role'       => ['required', Rule::in(Role::ADMIN, Role::WAREHOUSE, Role::VENDOR)],
            'outlet'     => ['required_if:role,' . Role::VENDOR, 'integer', 'exists:outlets,id'],
            'warehouse'  => ['required_if:role,' . Role::WAREHOUSE, 'integer', 'exists:warehouses,id'],
            'phone'      => ['required', 'regex:/^[0-9]{9}+$/'],
            'email'      => ['required', 'email'],
            'password'   => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
            'files'      => ['required', 'array'],
            'files.*'    => ['required', 'file', 'mimes:pdf,doc', 'max:5120'],
        ];
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->get('name'),
            'positionId'  => $this->get('position'),
            'address'     => $this->get('address'),
            'isLimited'   => $this->boolean('is_limited'),
            'expired'     => $this->string('expired'),
            'role'        => $this->get('role'),
            'outletId'    => $this->get('outlet'),
            'warehouseId' => $this->get('warehouse'),
            'phone'       => $this->get('phone'),
            'email'       => $this->get('email'),
            'password'    => $this->get('password'),
            'files'       => $this->file('files'),
        ];
    }
}

