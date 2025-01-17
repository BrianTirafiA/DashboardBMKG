<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [  
        'name',
        'email',  
        'fullname',
        'password',  
        'password_confirmation',
        'nip',  
        'no_telepon',  
        'unit_kerja_id',
        'role',
        'profile-photo',
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

    public function isAdmin()  
    {  
        return $this->role === 'admin'; // Adjust according to your role logic  
    }  
    
    public function isUser()  
    {  
        return $this->role === 'user'; // Adjust according to your role logic  
    } 

    public function unit_kerja()  
       {  
           return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');  
       } 
    }