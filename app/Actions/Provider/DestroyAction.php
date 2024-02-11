<?php

namespace App\Actions\Provider;

use App\Core\Actions\CoreAction;
use App\Models\Provider;
use Storage;

class DestroyAction extends CoreAction
{
    public function handle(Provider $provider)
    {
        foreach ($provider->files as $file) {
            if (Storage::exists($file)) {
                Storage::delete($file);
            }
        }

        $provider->delete();
    }
}
