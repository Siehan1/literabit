<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\missionAssignments;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'profil',
        'password',
        'exp'
    ];

    public function histories(): HasMany
    {
        return $this->hasMany(History::class);
    }
    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function levelInfo(){
        return $this->hasOne(LevelTreshold::class, 'level', 'level');
    }
    public function badges(){
        return $this->belongsToMany(badge::class,'user_badges')->withTimestamps();
    }

    /**
     * Get all of the resumes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resumes(): HasMany
    {
        return $this->hasMany(Resume::class);
    }

    public function missionAssignments(){
        return $this->hasMany(misionAsignment::class);
    }
    
    public function hasilKuis()
    {
        return $this->hasMany(HasilKuis::class);
    }
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
}
