<?php

namespace App\Http\Requests\Provider;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Provider\StoreRequestParams;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        return [
            'organization_name' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'organization_address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'organization_info' => ['required', 'string', 'max:400'],
            'files' => ['required', 'array'],
            'files.*' => ['required', 'file', 'mimes:pdf,doc', 'max:5120'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function toArray(): array
    {
        return [
            'organizationName' => $this->get('organization_name'),
            'providerFullName' => $this->get('full_name'),
            'countryId' => $this->get('country_id'),
            'organizationAddress' => $this->get('organization_address'),
            'phone' => $this->get('phone'),
            'email' => $this->get('email'),
            'organizationInfo' => $this->get('organization_info'),
            'files' => $this->file('files'),
        ];
    }
}

