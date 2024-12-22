<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CourseVideo extends Model
{
    use HasUuids;
    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
