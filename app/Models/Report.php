<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'type',
        'notes',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
