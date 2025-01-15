<?php

namespace App\Trait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait ImageUpload
{
    public function uploadImage($request, $inputName, $path)
    {
        if ($request->hasFile($inputName)) {

            $image = $request->file($inputName);

            $imageName = time() . '_' . rand() . '.' . $image->extension();

            $image->move(public_path($path), $imageName);

            return $imageName;
        }
        return null;
    }
    public function updateImage($request, $inputName, $path, $oldImage)
    {
        if ($request->hasFile($inputName)) {

            $this->deleteImage($path, $oldImage);

            $image = $request->file($inputName);

            $imageName = time() . '_' . rand() . '.' . $image->extension();

            $image->move(public_path($path), $imageName);

            return $imageName;
        }
        return $oldImage;
    }
    public function deleteImage($path, $oldImage)
    {
        if (File::exists(public_path($path . $oldImage))) {

            File::delete(public_path($path . $oldImage));
        }
    }
    public function imageInterventionUploadImage($request, $inputName, $path, $width, $height)
    {
        if ($request->hasFile($inputName)) {
            $image = $request->file($inputName);

            $directory = public_path($path);

            if (!is_dir($directory)) {

                mkdir($directory, 0777, true);
            }

            $imageName = time() . '_' . rand() . '.' . $image->extension();

            $image = Image::make($image)->resize($width, $height);

            $image->save($directory . $imageName);


            return $imageName;
        }
    }
    public function imageInterventionUpdateImage($request, $inputName, $path, $width, $height, $oldImage)
    {
        if ($request->hasFile($inputName)) {
            $this->deleteImage($path, $oldImage);

            $image = $request->file($inputName);

            $directory = public_path($path);

            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }

            $imageName = time() . '_' . rand() . '.' . $image->extension();

            $image = Image::make($image)->resize($width, $height);

            $image->save($directory . $imageName);

            return $imageName;
        }
        return $oldImage;
    }
}
