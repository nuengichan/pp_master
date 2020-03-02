<?php

namespace App\Repositories;

use App\Models\Gallery;

use App\Repositories\HomeRepositoryInterface as HomeRepositoryInterface;

class HomeRepository implements HomeRepositoryInterface
{
    public function checkPhoto($params)
    {
        if (!empty($params)) {
            $user_param = [
                'user_id' => array_get($params, 'user_id')
            ];

            $user = Gallery::where($user_param)->get();

            return json_decode($user, 1);
        }

        return false;
    }
}
