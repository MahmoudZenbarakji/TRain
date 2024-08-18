<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['subscription_id', 'amount', 'date'];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
    use HasFactory;
}
