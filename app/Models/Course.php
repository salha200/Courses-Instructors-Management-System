<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // استدعاء الترايت

class Course extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'description', 'start_date'];
//relation many to many wiyh instructor
    public function instructors()
    {
        return $this->belongsToMany(Instructor::class);
    }
}
