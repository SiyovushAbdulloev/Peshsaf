<?php

namespace App\Actions\Product;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Product\StoreRequestParams;
use App\Models\Dictionaries\Category;
use App\Models\Dictionaries\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params, Category $category): Product
    {
        $product = $category->products()->create([
            'name' => $params->name,
            'active_ingredient_id' => $params->activeIngredientId,
            'measure_id' => $params->measureId,
            'country_id' => $params->countryId,
            'status' => $params->status,
            'expiry_date' => Carbon::parse($params->expireDate),
            'barcode' => $params->barcode,
            'description' => $params->description,
        ]);

        foreach ($params->files as $file) {
            $product->files()->create([
                'filename' => Storage::put('', $file),
                'original_filename' => $file->getClientOriginalName(),
                'mimetype' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        return $product;
    }
}
