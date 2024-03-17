<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentModal extends Model
{
    use HasFactory;
    protected $table   = 'payment';
    public $timestamps = true;
    protected $fillable = [
        'course_id',
        'pengguna_id',
        'tagihan_id',
        'no_order',
        'total_tagihan',
        'total_terbayar',
        'status',
    ];

    public function scopeToken($query, $token)
    {
        $table  = $this->getTable();
        $column = $this->primaryKey;

        return $query->where(DB::Raw("md5(concat({$table}.{$column}, '-', date_format(curdate(), '%Y%m%d')))"), $token);
    }
}
