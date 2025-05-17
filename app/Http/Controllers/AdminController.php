<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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

    public function showDoctors(Request $request)
    {
        $doctors = Doctor::all();

        return view('admin.show_doctors',["doctors" => $doctors]);
    }

    public function deleteDoctors(int $id)
    {
        Doctor::destroy($id);
        return back()->with('success', 'Doctor Deleted Successfully');

    }

    public function editDoctors(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.edit_doctor',["doctor" => $doctor]);

    }

    public function updateDoctors(Request $request, int $id)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11|regex:/(01)[0-9]{9}/',
            'room' => 'required|string|max:20',
            'speciality' => 'required|string|max:20',
        ]);

        $doctor = Doctor::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time(). '.'. $image->getClientOriginalExtension();

            $request->file('image')->move('doctor_image', $imageName);
            $attributes['image'] = $imageName;
        }else{
            $attributes['image'] = $doctor->image;
        }
        $doctor->update($attributes);

        return redirect()->back()->with('success', 'Doctor Updated Successfully');
    }

    public function emailUsers(string $id)
    {
        $appointment = Appointment::find($id);
        return view('admin.email_users',["appointment" => $appointment]);
    }

    public function sendEmailUsers(Request $request, string $id)
    {
        $appointment = Appointment::find($id);

        $attributes = $request->validate([
            'greeting' => 'required|string|max:255',
            'body' => 'required|string|max:255',
            'actiontext' => 'required|string|max:255',
            'actionurl' => 'required|string|max:255',
            'endpart' => 'required|string|max:255',

        ]);

        Notification::send($appointment, new SendEmailNotification($attributes));
        return redirect()->back()->with('success', 'Email Sent Successfully');

    }
}
