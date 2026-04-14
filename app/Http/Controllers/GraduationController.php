<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

use App\Models\Setting;

class GraduationController extends Controller
{
    public function index()
    {
        $announcement_time = Setting::getValue('announcement_time');
        return view('welcome', compact('announcement_time'));
    }

    public function check(Request $request)
    {
        $announcement_time = Setting::getValue('announcement_time');
        if ($announcement_time && now() < \Carbon\Carbon::parse($announcement_time)) {
             return redirect()->route('home');
        }

        $request->validate([
            'nisn' => 'required|numeric'
        ]);

        $student = Student::where('nisn', $request->nisn)->first();

        return view('welcome', compact('student', 'announcement_time'))->with('searched', true);
    }
}
