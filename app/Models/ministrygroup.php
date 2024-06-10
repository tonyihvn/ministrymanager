<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ministrygroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(user::class, 'id', 'user_id');
    }

    public function settings()
    {
        return $this->hasMany(settings::class, 'ministrygroup_id', 'id');
    }
}
