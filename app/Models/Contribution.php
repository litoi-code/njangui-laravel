<?php

// app/Models/Contribution.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = ['member_id', 'fund_id', 'amount', 'date', 'host', 'location'];

    // Relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }

    public function host()
    {
        return $this->belongsTo(Member::class, 'host_id');
    }
}