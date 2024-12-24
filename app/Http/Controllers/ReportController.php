<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        if (account()->role == 'superadmin') {
            $courses = Course::latest()->get();
        } else {
            $courses = Course::where('user_id', account()->id)->latest()->get();
        }

        $data = [
            'title' => 'Report',
            'courses' => $courses
        ];

        return view('report.index', $data);
    }
}
