<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        //'avatar',
        'password',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::upper($value)
        );
    }

    // User.php
public function department()
{
    return $this->belongsTo(Department::class);
}

protected static function booted()
    {
        static::created(function ($user) {
            // Assign the default role of "User" to every new user
            $user->assignRole('User');
        });
    }


    // protected function password(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn ($value) => bcrypt($value)
    //     );
    // }

    // protected function isAdmin(): Attribute
    // {
    //     $admins = ['rajindasamarasinghe0621@gmail.com'];
    //     return Attribute::make(
    //         get: fn () => in_array($this->email, $admins)
    //     );
    // }

    // public function tickets(): HasMany
    // {
    //     return $this->hasMany(Ticket::class);
    // }
}
