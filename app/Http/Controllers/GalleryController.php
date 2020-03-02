<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;

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
        $imageName  = $image->getClientOriginalName();
        $image_size = $image->getSize();
        $image_type = $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
       
        
        $imageUpload             = new Gallery();
        $imageUpload->file_name  = $imageName;
        $imageUpload->size       = $image_size;
        $imageUpload->user_id    = $user['id'];
        $imageUpload->image_type = $image_type;
        $imageUpload->save();
        return response()->json(['success' => $imageName]);
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
