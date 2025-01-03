<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reports extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ministry()
    {
        return $this->hasOne(ministries::class, 'id', 'ministry_id');
    }
}
