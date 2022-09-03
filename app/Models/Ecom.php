<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecom extends Model
{
    use HasFactory;

    public function ecom()
    {
        return $this->hasMany(Log::class);
    }
}
