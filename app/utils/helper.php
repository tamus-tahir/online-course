<?php

use App\Models\CourseStudent;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

function successCreateMessage()
{
  return 'Data saved successfully';
}

function successUpdateMessage()
{
  return 'Data updated successfully';
}

function successDeleteMessage()
{
  return 'Data deleted successfully';
}

function getSetting()
{
  return Setting::get()->first();
}

function account()
{
  return Auth::user();
}

function getCountStudentCourse($id)
{
  return CourseStudent::where('course_id', $id)->where('status', 1)->count();
}

function getSumIncome($id)
{
  return CourseStudent::where('course_id', $id)->where('status', 1)->sum('ammount');
}
