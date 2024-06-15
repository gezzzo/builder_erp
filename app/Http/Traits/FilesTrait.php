<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait FilesTrait
{
    /**
     * @param $request
     * @param $file_parameter
     * @param $path
     * @return string
     */
    public function binaryImageUpload($request, $file_parameter, $path): string
    {
        $file = $request->file($file_parameter);
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('storage/' . $path, $filename);
        return $filename;
    }

    function base64ImageUpload($data, $destinationDirectory)
    {
        // Remove the "data:image/png;base64," or "data:image/jpeg;base64," prefix
        $imageData = substr($data, strpos($data, ',') + 1);

        // Get the image type (either png or jpeg)
        $imageType = explode(';', explode(':', substr($data, 0, strpos($data, ',')))[1])[0];

        // Generate a unique filename
        $filename = time() . '.' . ($imageType === 'image/png' ? 'png' : 'jpg');

        // Decode Base64 string to binary data
        $imageData = base64_decode($imageData);

        // Check if the destination directory is writable
        if (!Storage::disk('public')->exists($destinationDirectory)) {
            Storage::disk('public')->makeDirectory($destinationDirectory);
        }

        // Store binary data into a file using Laravel's Storage facade
        if (Storage::disk('public')->put($destinationDirectory . '/' . $filename, $imageData)) {
            return $filename;
        } else {
            return false;
        }
    }

    /**
     * @param $data
     * @param $destinationDirectories
     * @return array
     */
    function base64ImageMultiUpload($data, $destinationDirectories): array
    {
        $uploadedImages = [];

        foreach ($uploadedImages as $uploadedImage) {
            $uploadedImage = $this->base64ImageUpload($uploadedImages, $destinationDirectories);
            if ($uploadedImage) {
                $uploadedImages[] = $uploadedImage;
            }
        }
        return $uploadedImages;
    }

    /**
     * @param $filename
     * @param $imageFolder
     * @return string
     */
    function getImgPath($filename, $imageFolder): string
    {
        if (!empty($filename)) {
            $base_url = url('/');
            return $base_url . '/storage/' . $imageFolder . '/' . $filename;
        } else {
            return '';
        }
    }
}
