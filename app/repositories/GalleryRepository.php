<?php

namespace App\Repositories;

use App\Models\Gallery;

use App\Repositories\GalleryRepositoryInterface as GalleryRepositoryInterface;

class GalleryRepository implements GalleryRepositoryInterface
{
    public function uploadPhoto($params)
    {
        if (!empty($params)) {

            $imageUpload = new Gallery;
            $imageUpload->file_name  = array_get($params, 'image_name');
            $imageUpload->size       = array_get($params, 'image_size');
            $imageUpload->user_id    = array_get($params, 'user.id');
            $imageUpload->image_type = array_get($params, 'image_type');
            $imageUpload->save();

            return json_decode($imageUpload, 1);
        }

        return false;
    }
}
