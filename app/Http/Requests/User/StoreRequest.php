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
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
            'position' => ['required', 'integer', 'exists:positions,id'],
            'outlet' => ['required_if:role,' . Role::VENDOR, 'integer', 'exists:outlets,id'],
            'warehouse' => ['required_if:role,' . Role::WAREHOUSE, 'integer', 'exists:warehouses,id'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'regex:/^[0-9]{9}+$/'],
            'is_limited' => ['required', 'bool'],
            'role' => ['required', Rule::in(Role::ADMIN, Role::WAREHOUSE, Role::VENDOR)],
            'expired' => ['required_if:is_limited,true', 'string'],
            'files' => ['required', 'array'],
            'files.*' => ['required', 'file', 'mimes:pdf,doc', 'max:5120'],
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
            'role' => $this->get('role'),
            'expired' => $this->string('expired'),
            'password' => $this->get('password'),
            'files' => $this->file('files'),
        ];
    }
}

