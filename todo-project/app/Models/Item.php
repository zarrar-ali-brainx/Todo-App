<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name',
        'user_id',
        'completed',
        'completed_at'];

    protected $casts = [
        'completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    protected $dates = ['completed_at'];
}
