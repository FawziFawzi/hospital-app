<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('can:is-admin');
    }

    public function addDoctor()
    {
        return view('admin.add_doctor');
    }

    public function storeDoctor(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11|regex:/(01)[0-9]{9}/',
            'room' => 'required|string|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'speciality' => 'required|string|max:20',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time(). '.'. $image->getClientOriginalExtension();

            $request->file('image')->move('doctor_image', $imageName);
        }

        Doctor::create([
            'name' => $attributes['name'],
            'phone' => $attributes['phone'],
            'room' => $attributes['room'],
            'image' => $imageName,
            'speciality' => $attributes['speciality'],
        ]);

        return redirect()->back()->with('message', 'Doctor Added Successfully');

    }

    public function showAppointment()
    {
        $appointments = Appointment::all();

        return view('admin.show_appointment',['appointments' => $appointments]);
    }

    public function approveAppointment(int $id)
    {
        Appointment::find($id)->update(['status' => 'Approved']);
        return back()->with('success', 'Appointment Approved Successfully');
    }
    public function cancelAppointment(int $id)
    {
        Appointment::find($id)->update(['status' => 'Cancelled']);
        return back()->with('success', 'Appointment Cancelled Successfully');
    }
}
