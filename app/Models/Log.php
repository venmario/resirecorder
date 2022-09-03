<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'users_username');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class,'merchants_id');
    }
    
    public function ecom()
    {
        return $this->belongsTo(Ecom::class,'ecoms_id');
    }

    public function ekspdisi()
    {
        return $this->belongsTo(Ekspedisi::class,'ekspedisis_id');
    }
}
