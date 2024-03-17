<?php

namespace App\Actions\Product;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Product\UpdateRequestParams;
use App\Models\Dictionaries\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UpdateAction extends CoreAction
{
    public function handle(UpdateRequestParams $params, Product $product): Product
    {
        $product->update([
            'name'                 => $params->name,
            'active_ingredient_id' => $params->activeIngredientId,
            'measure_id'           => $params->measureId,
            'country_id'           => $params->countryId,
            'status'               => $params->status,
            'expiry_date'          => Carbon::parse($params->expireDate),
            'barcode'              => $params->barcode,
            'description'          => $params->description,
        ]);

        if ($params->files) {
            foreach ($params->files as $file) {
                $product->files()->create([
                    'filename'          => Storage::put('products', $file),
                    'original_filename' => $file->getClientOriginalName(),
                    'mimetype'          => $file->getClientMimeType(),
                    'size'              => $file->getSize(),
                ]);
            }
        }

        return $product;
    }
}
