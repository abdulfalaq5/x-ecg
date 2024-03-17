<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MateriCourseModal extends Model
{
    use HasFactory;
    protected $table   = 'materi_course';
    public $timestamps = true;
    protected $fillable = [
        'course_id',
        'star_date',
        'end_date',
        'title_materi',
        'status_materi',
        'des_materi',
        'file_materi',
        'link_video',
    ];

    public function scopeToken($query, $token)
    {
        $table  = $this->getTable();
        $column = $this->primaryKey;

        return $query->where(DB::Raw("md5(concat({$table}.{$column}, '-', date_format(curdate(), '%Y%m%d')))"), $token);
    }
}
