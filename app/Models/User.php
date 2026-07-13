<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPeriodista(): bool
    {
        return $this->role === 'periodista';
    }

    public function isRrhh(): bool
    {
        return $this->role === 'rrhh';
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function tourists()
    {
        return $this->hasMany(Tourist::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function profesionales()
    {
        return $this->hasMany(Profesional::class);
    }
}
