<?php
namespace App\Actions;

use App\Http\Requests\CarRequest;
use App\Http\Requests\UserPictureRequest;
use App\Http\Requests\UserRequest;
use App\Models\StorageLinker;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SetImageName
{
    /**
     * @param UserRequest|UserPictureRequest|CarRequest $request
     * @param User $model
     * @return string|null
     */
    public function handle(UserRequest|UserPictureRequest|CarRequest $request, Model $model): string|null
    {
        if ($request->hasFile('image')) {
            $storageLinker = new StorageLinker([
                $model->name ?? $model->sign,
                $request->file('image')->extension()]);

            $imageName = $storageLinker['hash'];

            Storage::disk('public/media')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
        }
        $model->image = $imageName ?? $model->image ?? 'testCar.png';

        return $model->image;
    }
}
