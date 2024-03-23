<?php

namespace App\Actions\Warehouse\Sale;

use App\Actions\Warehouse\RemoveWarehouseProductAction;
use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Sale\StoreRequestParams;
use App\Models\Client;
use App\Models\Product;
use App\Models\Role;
use App\Models\Sale;
use App\Models\WarehouseRemainProduct;
use Illuminate\Support\Facades\Storage;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Sale
    {
        $client = Client::firstOrCreate([
            'id' => $params->clientId,
        ], [
            'name'    => $params->clientName,
            'phone'   => $params->clientPhone,
            'address' => $params->clientAddress,
        ]);

        if ($params->clientPhoto) {
            $file = $params->clientPhoto;
            $client->image()->delete();
            $client->image()->create([
                'filename'          => Storage::put('clients', $file),
                'original_filename' => $file->getClientOriginalName(),
                'mimetype'          => $file->getClientMimeType(),
                'size'              => $file->getSize(),
            ]);
        }

        $model = match (auth()->user()->role->name) {
            Role::WAREHOUSE => auth()->user()->warehouse,
            Role::VENDOR => auth()->user()->outlet,
        };

        $sale = $model->sales()->create([
            'date'           => $params->date,
            'client_id'      => $client->id,
            'client_name'    => $client->name,
            'client_phone'   => $client->phone,
            'client_address' => $client->address,
        ]);

        foreach ($params->products as $productId) {
            $sale->products()->create([
                'product_id' => $productId,
            ]);

            $product = Product::find($productId);

            $newProduct             = $product->replicate();
            $newProduct->model_type = Client::class;
            $newProduct->model_id   = $client->id;
            $newProduct->save();

            $newProduct->status()->transitionTo('sold');

            $product->history = true;
            $product->save();

            // Удаляем продукт из остатка склада
            app(RemoveWarehouseProductAction::class)->execute($product);
        }

        return $sale;
    }
}
