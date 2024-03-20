<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function admin(){
        return $this->hasOne(Admin::class);
    }

    public function student(){
        return $this->hasOne(Student::class);
    }

    // generate random username for users
    public function generateUsername()
    {
        // Combine first name and last name
        $fullName = $this->last_name;

        // Convert full name to array of characters
        $characters = str_split($fullName);

        // Shuffle the characters randomly
        shuffle($characters);

        // Generate the username by joining shuffled characters
        $username = implode('', $characters);

        // Check if username already exists
        $count = User::where('username', $username)->count();

        // If username exists, regenerate
        if ($count > 0) {
            return $this->generateUsername();
        }

        return $username;
    }
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
        'password' => 'hashed',
        'previous_login_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];
}
