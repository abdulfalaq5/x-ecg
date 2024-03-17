<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BankQuizModal extends Model
{
    use HasFactory;
    protected $table   = 'bank_quiz';
    public $timestamps = true;
    protected $fillable = [
        'course_id',
        'materi_id',
        'title_quiz',
        'des_quiz',
        'waktu_quiz',
        'waktu_akhir_quiz',
    ];

    public function scopeToken($query, $token)
    {
        $table  = $this->getTable();
        $column = $this->primaryKey;

        return $query->where(DB::Raw("md5(concat({$table}.{$column}, '-', date_format(curdate(), '%Y%m%d')))"), $token);
    }
}
