<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::latest();

        if (request('search')) {
            $courses->where('name', 'like', '%' . request('search') . '%');
        }

        $data = [
            'title' => 'Home',
            'categories' => Category::all(),
            'courses' => $courses->paginate(3)->withQueryString(),
            'countCategory' => Category::count(),
            'countCourse' => Course::count(),
            'countLecture' => User::where('role', '!=', 'student')->count(),
            'countStudent' => User::where('role', '!=', 'superadmin')->count(),
        ];

        return view('home.index', $data);
    }

    public function faq()
    {
        return view('home.faq', ['title' => 'Frequently Asked Questions']);
    }

    public function detail($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $data = [
            'title' => 'Detail Course',
            'course' =>  $course,
        ];

        return view('home.detail', $data);
    }
}
