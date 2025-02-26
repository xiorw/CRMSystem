<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;

    protected $table = 'interactions';

    protected $fillable = [
        'customer_id',
        'type',
        'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
