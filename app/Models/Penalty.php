<?php

// app/Models/Penalty.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'reason', 'amount', 'is_paid'];

    // Relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}