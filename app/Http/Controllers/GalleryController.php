<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GalleryRepository;

class GalleryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function multifileupload()
    {
        
        return view('gallery');
    }

    public function uploadPhoto(Request $request)
    {
        $user       = Auth::user();
        $image      = $request->file('file');
        $image_name  = $image->getClientOriginalName();
        $image_size = $image->getSize();
        $image_type = $image->getClientOriginalExtension();
        $image->move(public_path('images'), $image_name);
       
        $params = [
            'user'       => $user,
            'image'      => $image,
            'image_name' => $image_name,
            'image_size' => $image_size,
            'image_type' => $image_type
        ];


        $imageUpload = new GalleryRepository();
        $response    = $imageUpload->uploadPhoto($params);
        
        return response()->json(['success' => $response]);
    }

    public function deletePhoto(Request $request)
    {
        $user        = Auth::user();
        $filename    = $request->get('filename');
        
        $param = [
            'file_name' => $filename,
            'user_id'   => array_get($user, 'id'),
        ];

        $imageUpload = new Gallery();
        $imageUpload = $imageUpload->where($param)->delete();
        $path        = public_path() . '/images/' . $filename;

        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => $filename]);
    }
}
