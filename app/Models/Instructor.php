<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'experience', 'specialty'];
    protected $dates = ['deleted_at'];
//relation many to many with  courses
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
