<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'fund_type', 'amount', 'date'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
