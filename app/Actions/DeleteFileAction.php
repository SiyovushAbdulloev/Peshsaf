<?php

namespace App\Actions;

use App\Core\Actions\CoreAction;
use App\Models\File;
use Storage;

class DeleteFileAction extends CoreAction
{
    public function handle(File $file): void
    {
        $url = $file->filename;

        if (Storage::exists($url)) {
            Storage::delete($url);
        }

        $file->delete();
    }
}
