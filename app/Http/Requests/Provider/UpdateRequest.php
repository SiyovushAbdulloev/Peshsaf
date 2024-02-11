<?php

namespace App\Http\Requests\Provider;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Provider\UpdateRequestParams;

class UpdateRequest extends CoreFormRequest
{
    protected string $params = UpdateRequestParams::class;

    public function rules(): array
    {
        return [
            'organization_name' => ['required', 'string', 'max:255'],
            'provider_full_name' => ['required', 'string', 'max:255'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'organization_address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'organization_info' => ['required', 'string', 'max:400'],
            'files' => ['nullable', 'array'],
            'files.*' => ['required_with:files', 'file', 'mimes:pdf,doc', 'max:5120'],
        ];
    }

    public function toArray(): array
    {
        return [
            'organizationName' => $this->get('organization_name'),
            'providerFullName' => $this->get('provider_full_name'),
            'countryId' => $this->get('country_id'),
            'organizationAddress' => $this->get('organization_address'),
            'phone' => $this->get('phone'),
            'email' => $this->get('email'),
            'organizationInfo' => $this->get('organization_info'),
            'files' => $this->file('files'),
        ];
    }
}

