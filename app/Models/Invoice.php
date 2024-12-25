<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'store_id',
        'plan_id',
        'amount',
        'status',
        'issue_date',
        'due_date',
    ];

    /**
     * Relationships
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
