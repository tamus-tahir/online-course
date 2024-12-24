<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\CourseStudent;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (account()->role == 'superadmin') {
            $courseStudents = CourseStudent::latest()->get();
        } else {
            $courseStudents = CourseStudent::where('user_id', account()->id)->latest()->get();
        }

        $data = [
            'title' => 'Subscribtion',
            'courseStudents' => $courseStudents
        ];

        return view('coursestudent.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required',
            'proof' => 'required|image|mimes:png,jpg,jpeg,svg|max:512'
        ]);

        $course = Course::where('slug', $request->slug)->first();

        $validated['proof'] = $request->file('proof')->store('proof', 'public');
        $validated['course_id'] = $course->id;
        $validated['ammount'] = $course->price;
        $validated['user_id'] = account()->id;
        $validated['status'] = 0;
        CourseStudent::create($validated);
        return redirect()->route('course-student.index')->with('success', successCreateMessage());
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseStudent $courseStudent)
    {
        $data = [
            'title' => $courseStudent->course->name,
            'courseStudent' => $courseStudent
        ];

        return view('coursestudent.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseStudent $courseStudent)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseStudent $courseStudent)
    {
        $validated['status'] = 1;
        $courseStudent->update($validated);
        return redirect()->route('course-student.index')->with('success', successUpdateMessage());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseStudent $courseStudent)
    {
        //
    }
}
