<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['name', 'type', 'balance'];

    public function transfersAsSource()
    {
        return $this->hasMany(Transfer::class, 'source_account_id');
    }

    public function transfersAsDestination()
    {
        return $this->hasMany(Transfer::class, 'destination_account_id');
    }

    public function loansAsSource()
    {
        return $this->hasMany(Loan::class, 'source_account_id');
    }

    public function loansAsDestination()
    {
        return $this->hasMany(Loan::class, 'destination_account_id');
    }
}