<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'schedule_id', 'content'];
    
    public function schedule()
    {
        return $this->belongsToMany(Schedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
