<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyCourseModal extends Model
{
    use HasFactory;
    protected $table   = 'mycourses';
    public $timestamps = true;
    protected $fillable = [
        'peserta_id',
        'course_id',
        'status',
    ];
}
