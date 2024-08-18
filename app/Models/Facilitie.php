<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilitie extends Model
{
    protected $fillable =   ['type'];

    public function sports(){
        return $this->belongsToMany(Sport::class);
    }
    public function rooms(){
        return  $this->hasMany(Room::class);
    }
    use HasFactory;
}
