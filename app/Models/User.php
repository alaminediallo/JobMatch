<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'role_id',
        'prenom',
        'tel',
        'etat',
        'adresse',
        'nom_entreprise',
        'description_entreprise',
        'type_entreprise_id',
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
     * Vérifie si l'utilisateur a une permission spécifique via son rôle.
     */
    public function hasPermissionTo($permission): bool
    {
        // Vérifie si le rôle de l'utilisateur a la permission spécifiée
        return $this->role && $this->role->permissions()->where('name', $permission)->exists();
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Vérifie si l'utilisateur est administrateur.
     */
    public function isAdministrator(): bool
    {
        // Vérifie si l'utilisateur possède un rôle nommé 'Administrateur'
        return $this->role && $this->role->name === 'Administrateur';
    }

    /**
     * Scope a query to only include active users.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('etat', true);
    }

    public function typeEntreprise(): BelongsTo
    {
        return $this->belongsTo(TypeEntreprise::class);
    }

    /**
     * Les langues parlées par cet utilisateur.
     */
    public function langues(): BelongsToMany
    {
        return $this->belongsToMany(Langue::class, 'candidat_langue')
            ->withPivot('niveau');
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
            'etat' => 'boolean',
        ];
    }
}
