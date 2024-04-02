<?php

namespace App\Actions\User;

use App\Actions\DeleteFileAction;
use App\Core\Actions\CoreAction;
use App\Models\User;

class DestroyAction extends CoreAction
{
    public function handle(User $user)
    {
//        foreach ($user->files as $file) {
//            app(DeleteFileAction::class)->execute($file->filename);
//        }
//
//        $user->files()->delete();
        $user->delete();
    }
}
