<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseVideo;
use Illuminate\Http\Request;

class CourseVideoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        $data = [
            'title' => 'Create Course Video',
            'course' => $course
        ];

        return view('coursevideo.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'video' => 'required',
            'order' => 'required',
            'course_id' => 'required',
        ]);
        CourseVideo::create($validated);
        return redirect()->route('coursevideo.show', $request->course_id)->with('success', successCreateMessage());
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $data = [
            'title' => $course->name,
            'course' => $course
        ];

        return view('coursevideo.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseVideo $courseVideo)
    {
        $data = [
            'title' => 'Edit Course Video',
            'courseVideo' => $courseVideo
        ];

        return view('coursevideo.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseVideo $courseVideo)
    {
        $validated = $request->validate([
            'name' => 'required',
            'video' => 'required',
            'order' => 'required',
        ]);
        $courseVideo->update($validated);
        return redirect()->route('coursevideo.show', $courseVideo->course_id)->with('success', successUpdateMessage());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseVideo $courseVideo)
    {
        $courseVideo->delete();
        return redirect()->route('coursevideo.show', $courseVideo->course_id)->with('success', successDeleteMessage());
    }

    public function import(Request $request)
    {
        $file = $request->file('excel')->store('file', 'public');
        $fileName = 'storage/' . $file;
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($fileName);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $row => $col) {
            if ($row == 0) {
                continue;
            }

            $data = [
                'name' => $col[0],
                'video' => $col[1],
                'order' => $col[2],
                'course_id' => $request->course_id
            ];

            CourseVideo::create($data);
        }

        return redirect()->route('coursevideo.show', $request->course_id)->with('success', successCreateMessage());
    }
}
