<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'umpan_baliks';

    protected $fillable = [
        'customer_id',
        'rating',
        'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
