<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MidtransModal extends Model
{
    use HasFactory;
    protected $table   = 'midtrans';
    public $timestamps = true;
    protected $fillable = [
        'no_order',
        'pengguna_id',
        'tagihan_id',
        'is_recurring',
        'cc_token_id',
        'total',
        'midtrans_statement',
        'transaction_status',
        'fraud_status',
        'payment_method',
        'payment_bank',
        'payment_va',
        'transaction_id',
        'response',
        'payment_at',
        'expired_at',
    ];

    public function scopeToken($query, $token)
    {
        $table  = $this->getTable();
        $column = $this->primaryKey;

        return $query->where(DB::Raw("md5(concat({$table}.{$column}, '-', date_format(curdate(), '%Y%m%d')))"), $token);
    }
}
