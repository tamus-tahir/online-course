<?php

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
