<?php

// app/Models/Member.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Member extends Model
{
    protected $fillable = ['name', 'balance'];

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function penalties()
    {
        return $this->hasMany(Penalty::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}