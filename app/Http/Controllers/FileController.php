<?php

namespace App\Http\Controllers;

use App\Actions\DeleteFileAction;
use App\Models\File;

class FileController extends Controller
{
    public function delete(File $file, DeleteFileAction $action)
    {
        $this->authorize('delete', $file);

        $action->execute($file);

        return true;
    }
}
