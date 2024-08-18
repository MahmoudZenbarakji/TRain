<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['name', 'description', 'discount_percentage'];

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }
    use HasFactory;
}
