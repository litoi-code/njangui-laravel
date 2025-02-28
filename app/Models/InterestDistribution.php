<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestDistribution extends Model
{
    use HasFactory;

    protected $fillable = ['fund_id', 'member_id', 'interest_amount', 'date'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }
}
