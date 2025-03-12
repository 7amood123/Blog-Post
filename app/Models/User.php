<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

     protected $fillable = [
        'age',
        'about',
        'is_subscribed',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        // making sure that the password is not hashed twice when checked for authentication 
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
        // bcrypt($password);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeSubscribers(Builder $query)
    {
        return $query->where('is_subscribed', true);
    }
}
