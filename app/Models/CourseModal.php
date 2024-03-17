<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CourseModal extends Model
{
    use HasFactory;
    protected $table   = 'course';
    public $timestamps = true;
    protected $fillable = [
        'code',
        'kategori_id',
        'klasifikasi_id',
        'instruktur',
        'title',
        'status',
        'live',
        'des',
        'cover',
        'harga',
        'waktu_per_minggu',
        'income'
    ];

    public function scopeToken($query, $token)
    {
        $table  = $this->getTable();
        $column = $this->primaryKey;

        return $query->where(DB::Raw("md5(concat({$table}.{$column}, '-', date_format(curdate(), '%Y%m%d')))"), $token);
    }
}
