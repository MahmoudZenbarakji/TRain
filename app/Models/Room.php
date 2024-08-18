<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'facility_id',
    ];
     public function sports(){
        return $this->belongsTOMany(Sport::class);
     }
     public function facility(){
        return $this->belongsTO(Facilitie::class);
     }
    use HasFactory;
}
