<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone_number',
        'subject_id',
        'gender',
        'address',
        'dob' // Add subject_id to the fillable attributes
    ];

    protected $attributes = [
        'phone_number' => null,
        'subject_id' => null,
        'gender' => null,
        'address' => null,
        'dob' => null
        // Add more columns as needed
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Define the relationship with the Subject model.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}