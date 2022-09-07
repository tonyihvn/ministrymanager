<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function members()
    {
        return $this->hasMany(User::class, 'settings_id', 'id');
    }

    public function ministrygroup()
    {
        return $this->belongsTo(ministrygroup::class, 'id', 'ministrygroup_id');
    }

    public function housefellowhips()
    {
        return $this->hasMany(housefellowhips::class, 'ministry_id', 'id');
    }

    public function ministries()
    {
        return $this->hasMany(ministries::class, 'ministry_id', 'id');
    }

    public function accountheads()
    {
        return $this->hasMany(accountheads::class, 'ministry_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany(attendance::class, 'ministry_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(transactions::class, 'ministry_id', 'id');
    }

    public function programmes()
    {
        return $this->hasMany(programmes::class, 'settings_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(tasks::class, 'ministry_id', 'id');
    }

    public function followups()
    {
        return $this->hasMany(followups::class, 'ministry_id', 'id');
    }
}
