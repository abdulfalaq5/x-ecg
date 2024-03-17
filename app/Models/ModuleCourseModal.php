<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModuleCourseModal extends Model
{
    use HasFactory;
    protected $table   = 'module_course';
    public $timestamps = true;
    protected $fillable = [
        'course_id',
        'materi_id',
        'title',
        'des',
        'file_materi',
        'link_video',
        'link_meet',
    ];

    public function scopeToken($query, $token)
    {
        $table  = $this->getTable();
        $column = $this->primaryKey;

        return $query->where(DB::Raw("md5(concat({$table}.{$column}, '-', date_format(curdate(), '%Y%m%d')))"), $token);
    }
}
