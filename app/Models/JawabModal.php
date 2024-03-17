<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JawabModal extends Model
{
    use HasFactory;
    protected $table   = 'jawab_quiz';
    public $timestamps = true;
    protected $fillable = [
        'course_id',
        'materi_id',
        'peserta_id',
        'quiz_detail_id',
        'jawab',
        'nilai',
    ];

    public function scopeToken($query, $token)
    {
        $table  = $this->getTable();
        $column = $this->primaryKey;

        return $query->where(DB::Raw("md5(concat({$table}.{$column}, '-', date_format(curdate(), '%Y%m%d')))"), $token);
    }
}
