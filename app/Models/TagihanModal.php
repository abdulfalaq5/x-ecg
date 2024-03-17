<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TagihanModal extends Model
{
    use HasFactory;
    protected $table   = 'tagihan';
    public $timestamps = true;
    protected $fillable = [
        'course_id',
        'pengguna_id',
        'total_tagihan',
        'status',
    ];

    public function scopeToken($query, $token)
    {
        $table  = $this->getTable();
        $column = $this->primaryKey;

        return $query->where(DB::Raw("md5(concat({$table}.{$column}, '-', date_format(curdate(), '%Y%m%d')))"), $token);
    }
}
