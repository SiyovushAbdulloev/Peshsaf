<?php

namespace App\Actions\Provider;

use App\Core\Actions\CoreAction;
use App\Models\Provider;
use Storage;

class DestroyFileAction extends CoreAction
{
    public function handle(Provider $provider, string $file)
    {
        if (Storage::exists($file)) {
            Storage::delete($file);
        }

        $files = array_filter($provider->files, function ($f) use ($file) {
            return $f !== $file;
        });

        $provider->update([
            'files' => $files
        ]);
    }
}
