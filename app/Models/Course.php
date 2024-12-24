<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasUuids;
    protected $guarded = ['id'];
    protected $with = ['category', 'user'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseVideos()
    {
        return $this->hasMany(CourseVideo::class);
    }

    public function courseVideosOrder()
    {
        return $this->hasMany(CourseVideo::class)->orderBy('order');
    }

    public function courseStudent()
    {
        return $this->hasMany(CourseStudent::class);
    }
}
