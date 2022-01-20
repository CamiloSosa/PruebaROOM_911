<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room911 extends Model
{
    use HasFactory;

    protected $table = 'room_911';

    protected $fillable = ['user_id', 'status'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
}
