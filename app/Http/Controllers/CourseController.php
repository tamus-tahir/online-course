<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (account()->role == 'superadmin') {
            $courses = Course::latest()->get();
        } else {
            $courses = Course::where('user_id', account()->id)->latest()->get();
        }

        $data = [
            'title' => 'Course',
            'courses' => $courses
        ];

        return view('course.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Create Course',
            'categories' => Category::all()
        ];

        return view('course.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:courses,name',
            'description' => 'required',
            'price' => 'required',
            'trailer' => 'required',
            'category_id' => 'required',
            'cover' => 'required|image|mimes:png,jpg,jpeg,svg|max:512'
        ]);

        $validated['cover'] = $request->file('cover')->store('course', 'public');
        $validated['slug'] = Str::slug($request->name);
        $validated['user_id'] = account()->id;
        Course::create($validated);
        return redirect()->route('course.index')->with('success', successCreateMessage());
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $data = [
            'title' => 'Edit Course',
            'categories' => Category::all(),
            'course' => $course
        ];

        return view('course.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:courses,name,' . $course->id,
            'description' => 'required',
            'price' => 'required',
            'trailer' => 'required',
            'category_id' => 'required',
            'cover' => 'sometimes|image|mimes:png,jpg,jpeg,svg|max:512'
        ]);

        if ($request->file('cover')) {
            $path = $request->file('cover')->store('course', 'public');
            $validated['cover'] = $path;
            if ($course->cover) {
                if (Storage::disk('public')->exists($course->cover)) {
                    Storage::disk('public')->delete($course->cover);
                }
            }
        }

        $validated['slug'] = Str::slug($request->name);

        $course->update($validated);
        return redirect()->route('course.index')->with('success', successUpdateMessage());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        if ($course->cover) {
            if (Storage::disk('public')->exists($course->cover)) {
                Storage::disk('public')->delete($course->cover);
            }
        }
        return redirect()->route('course.index')->with('success', successDeleteMessage());
    }
}
