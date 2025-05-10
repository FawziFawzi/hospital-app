<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        $doctors = Doctor::all();

        return view('user.home',['doctors' => $doctors]);
    }
    public function redirect()
    {
            if (  Auth::user()->usertype == '0'  ){
                $doctors = Doctor::all();

                return view('user.home',['doctors' => $doctors]);
            }else{
                return view('admin.home');
            }


    }
}
