<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repayment extends Model
{
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }}
