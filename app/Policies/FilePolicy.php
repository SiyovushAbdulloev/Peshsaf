<?php

namespace App\Policies;

use App\Models\File;
use App\Models\Role;
use App\Models\User;

class FilePolicy
{
    public function delete(User $user, File $file)
    {
        return $user->role->name === Role::ADMIN || $user->id === $file->fileable_id;
    }
}
