<?php

namespace App\Actions\User;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\User\UpdateRequestParams;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UpdateAction extends CoreAction
{
    public function handle(UpdateRequestParams $params, User $user): User
    {
        $user->update([
            'name'        => $params->name,
            'email'       => $params->email,
            'phone'       => $params->phone,
            'position_id' => $params->positionId,
            'address'     => $params->address,
            'is_limited'  => $params->isLimited,
            'expired'     => $params->isLimited ? Carbon::createFromFormat('d-m-Y', $params->expired) : null,
        ]);

        $user->syncRoles($params->role);

        match ($user->role->name) {
            Role::VENDOR => $user->update([
                'outlet_id' => $params->outletId,
            ]),
            Role::WAREHOUSE => $user->update([
                'warehouse_id' => $params->warehouseId,
            ]),
            default => true
        };

        if ($params->password) {
            $user->update([
                'password' => $params->password,
            ]);
        }

        if ($params->files) {
            foreach ($params->files as $file) {
                $user->files()->create([
                    'filename'          => Storage::put('users', $file),
                    'original_filename' => $file->getClientOriginalName(),
                    'mimetype'          => $file->getClientMimeType(),
                    'size'              => $file->getSize(),
                ]);
            }
        }

        return $user;
    }
}
