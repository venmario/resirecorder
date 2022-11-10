<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;
    protected $fillable = ['nama'];
    public $timestamps = false;
    public function log()
    {
        return $this->hasMany(Log::class);
    }
}
