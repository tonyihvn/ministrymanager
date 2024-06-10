<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class followups extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Member()
    {
        return $this->hasOne(User::class, 'id', 'member');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'id', 'assigned_to');
    }
}
