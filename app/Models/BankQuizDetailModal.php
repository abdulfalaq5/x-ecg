<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BankQuizDetailModal extends Model
{
    use HasFactory;
    protected $table   = 'bank_quiz_detail';
    public $timestamps = true;
    protected $fillable = [
        'course_id',
        'materi_id',
        'bank_quiz_id',
        'jenis',
        'pertanyaan',
        'jawaban',
        'option1',
        'option2',
        'option3',
        'option4',
        'bobot_nilai',
    ];

    public function scopeToken($query, $token)
    {
        $table  = $this->getTable();
        $column = $this->primaryKey;

        return $query->where(DB::Raw("md5(concat({$table}.{$column}, '-', date_format(curdate(), '%Y%m%d')))"), $token);
    }
}
