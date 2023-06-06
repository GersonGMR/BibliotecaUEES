<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'adress',
        'phone',
        'email',
        'password',
        'status'
    ];
}
