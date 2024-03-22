<?php

namespace App\Http\Requests\Supplier;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Supplier\UpdateRequestParams;

class UpdateRequest extends CoreFormRequest
{
    protected string $params = UpdateRequestParams::class;

    public function rules(): array
    {
        return [
            'organization_name'    => ['required', 'string', 'max:255'],
            'full_name'            => ['required', 'string', 'max:255'],
            'country'              => ['required', 'integer', 'exists:countries,id'],
            'organization_address' => ['required', 'string', 'max:255'],
            'phone'                => ['required', 'string'],
            'email'                => ['required', 'email'],
            'description'          => ['required', 'string', 'max:400'],
            'files'                => ['nullable', 'array'],
            'files.*'              => ['required_with:files', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }

    public function toArray(): array
    {
        return [
            'organizationName'    => $this->get('organization_name'),
            'fullName'            => $this->get('full_name'),
            'countryId'           => $this->get('country'),
            'organizationAddress' => $this->get('organization_address'),
            'phone'               => $this->get('phone'),
            'email'               => $this->get('email'),
            'description'         => $this->get('description'),
            'files'               => $this->file('files'),
        ];
    }
}

