<?php

namespace App\Models;

use App\Enums\StatutOffre;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offre extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'salaire_proposer',
        'type_offre',
        'date_debut',
        'date_fin',
        'description',
        'category_id',
        'statut',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // offre valide
    public function scopeValidated(Builder $query): Builder
    {
        return $query->where('statut', StatutOffre::VALIDER);
    }

    protected function casts(): array
    {
        return [
            'statut' => StatutOffre::class,
            'date_debut' => 'date',
            'date_fin' => 'date',
        ];
    }
}
