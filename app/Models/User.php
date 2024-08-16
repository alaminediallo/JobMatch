<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function hasPermissionTo($permission): bool
    {
        // Vérifie si l'utilisateur possède des rôles qui ont la permission spécifiée
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            // Filtre les rôles pour ceux qui ont la permission spécifiée
            $query->where('name', $permission);
        })->exists(); // Vérifie l'existence de ces rôles avec la permission
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdministrator(): bool
    {
        // Vérifie si l'utilisateur possède un rôle nommé 'Administrateur'
        return $this->roles()->where('nom', 'Administrateur')->exists(); // Vérifie l'existence de ce rôle
    }

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
