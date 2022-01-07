<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'birthdate',
        'address',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
