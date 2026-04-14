<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class GraduationController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function check(Request $request)
    {
        $request->validate([
            'nisn' => 'required|numeric'
        ]);

        $student = Student::where('nisn', $request->nisn)->first();

        return view('welcome', compact('student'))->with('searched', true);
    }
}
