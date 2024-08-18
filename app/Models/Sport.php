<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        
    ];
    public function Facilitie(){
        return $this->belongsTOmany(Facilitie::class);
    }
    public function Room(){
        return $this->belongsToMany(Room::class);
    }
    use HasFactory;
}
