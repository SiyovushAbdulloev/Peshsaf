<?php

namespace App\Http\Requests\Return;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Return\ProductStoreRequestParams;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends CoreFormRequest
{
    protected string $params = ProductStoreRequestParams::class;

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
            'product' => [
                'exists:products,id',
                Rule::unique('refund_products', 'product_id')
                    ->where(function (Builder $query) {
                        $query
                            ->where('refund_id', $this->return->id)
                            ->where('product_id', $this->product);
                    }),
            ],
        ];
    }

    public function toArray(): array
    {
        return [
            'productId' => $this->get('product'),
        ];
    }
}
