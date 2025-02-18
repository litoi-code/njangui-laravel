<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferDetail extends Model
{
    use HasFactory;

    protected $fillable = ['transfer_id', 'destination_account_id', 'amount'];

    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }

    public function destinationAccount()
    {
        return $this->belongsTo(Account::class, 'destination_account_id');
    }
}
