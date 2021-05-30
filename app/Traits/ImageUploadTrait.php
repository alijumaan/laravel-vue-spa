<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

trait ImageUploadTrait
{
    protected string $avatar_path = "app/public/assets/avatars/";
    protected int $avatar_height = 240;
    protected int $avatar_width = 240;

    public function uploadAvatar($img)
    {
        $imgName = $this->imageName($img);

        Image::make($img)->resize($this->avatar_width, $this->avatar_height)
            ->save(storage_path($this->avatar_path . $imgName));

        return $imgName;
    }

    public function imageName($img)
    {
        return $img->getClientOriginalName();
    }

}
