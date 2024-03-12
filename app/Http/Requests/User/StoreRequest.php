<?php

namespace App\Http\Requests\User;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\User\StoreRequestParams;

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
            'email' => ['required', 'email'],
            'phone' => ['required', 'regex:/^[0-9]{9}+$/'],
            'is_limited' => ['required', 'bool'],
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
            'email' => $this->get('email'),
            'phone' => $this->get('phone'),
            'isLimited' => $this->boolean('is_limited'),
            'expired' => $this->string('expired'),
            'password' => $this->get('password'),
            'files' => $this->file('files'),
        ];
    }
}

