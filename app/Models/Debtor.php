<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
