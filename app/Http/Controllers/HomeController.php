<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HomeRepository;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $view = [];
        $user = Auth::user();
        
        $home_repository = new HomeRepository();
        
        $param = [
            "user_id" => array_get($user, 'id')
        ];
        

        $photo = $home_repository->checkPhoto($param);
        //  print_r($photo); die;
        $view['photos'] = $photo;
        // echo '<pre>'; print_r($view); die;
        return view('home', $view);
    }
}
