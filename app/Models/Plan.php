<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    /** @use HasFactory<\Database\Factories\PlanFactory> */
    use HasFactory;

    protected $fillable = ['name', 'billing_cycle', 'price', 'description'];


    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
