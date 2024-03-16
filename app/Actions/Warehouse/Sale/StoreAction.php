<?php

namespace App\Actions\Warehouse\Sale;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Sale\StoreRequestParams;
use App\Models\Client;
use App\Models\Product;
use App\Models\Role;
use App\Models\Sale;
use Illuminate\Support\Facades\Storage;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params, string $role): Sale
    {
        $client = Client::firstOrCreate([
            'id' => $params->clientId,
        ], [
            'name'    => $params->clientName,
            'phone'   => $params->phone,
            'address' => $params->address,
        ]);

        if ($params->photo) {
            $file = $params->photo;
            $client->image()->delete();
            $client->image()->create([
                'filename'          => Storage::put('clients', $file),
                'original_filename' => $file->getClientOriginalName(),
                'mimetype'          => $file->getClientMimeType(),
                'size'              => $file->getSize(),
            ]);
        }

        $sale = [];

        switch ($role) {
            case Role::WAREHOUSE:
                $sale = auth()->user()->warehouse->sales()->create([
                    'date'           => $params->date,
                    'client_id'      => $client->id,
                    'client_name'    => $client->name,
                    'client_phone'   => $client->phone,
                    'client_address' => $client->address,
                ]);
                break;
            case Role::VENDOR:
                $sale = auth()->user()->outlet->sales()->create([
                    'date'           => $params->date,
                    'client_id'      => $client->id,
                    'client_name'    => $client->name,
                    'client_phone'   => $client->phone,
                    'client_address' => $client->address,
                ]);
                break;
        }

        foreach ($params->products as $productId) {
            $sale->products()->create([
                'product_id' => $productId,
            ]);

            $product = Product::find($productId);

            $newProduct             = $product->duplicate();
            $newProduct->model_type = Client::class;
            $newProduct->model_id   = $client->id;
            $newProduct->save();

            $newProduct->status()->transitionTo('sold');

            $product->history = true;
            $product->save();
        }

        return $sale;
    }
}
