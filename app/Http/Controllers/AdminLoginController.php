<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminlogin()
    {
        return view('blog.adminlogin');
    }
    public function index()
    {
        $user=Auth::user();
        $data=[
            'user'=>$user,
        ];
        return view('admins.index',$data);
    }

}

