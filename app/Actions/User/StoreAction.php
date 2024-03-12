<?php

namespace App\Actions\User;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\User\StoreRequestParams;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): User
    {
        $user = User::create([
            'name' => $params->name,
            'email' => $params->email,
            'phone' => $params->phone,
            'position_id' => $params->positionId,
            'address' => $params->address,
            'is_limited' => $params->isLimited,
            'expired' => Carbon::createFromFormat('d-m-Y', $params->expired),
            'password' => $params->password,
        ]);

        foreach ($params->files as $file) {
            $user->files()->create([
                'filename' => Storage::put('', $file),
                'original_filename' => $file->getClientOriginalName(),
                'mimetype' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        return $user;
    }
}
