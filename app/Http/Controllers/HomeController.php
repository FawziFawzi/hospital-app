<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
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

    public function appointment(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:50',
            'doctor' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:11|regex:/(01)[0-9]{9}/',
            'message' => 'required|string|max:400',
            'date' => 'required|date',
        ]);

        if (Auth::user()) {
            $credentials['user_id'] = Auth::id();
        }
        $credentials['status'] = 'In Progress';
        Appointment::create($credentials);
        return back()->with('success', 'Appointment Added Successfully');

    }

    public function appointments()
    {
        $appointments = Appointment::Where('user_id', Auth::id())->get();

        return view('user.user_appointments', ['appointments' => $appointments]);
    }

    public function destroyAppointment(int $id)
    {
        Appointment::Destroy($id);

        return back()->with('success', 'Appointment Deleted Successfully');
    }
}
