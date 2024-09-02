<?php

namespace App\Models;

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
        'is_validated',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeValidated(Builder $query, bool $validated = true): Builder
    {
        return $query->where('is_validated', $validated);
    }

    protected function casts(): array
    {
        return [
            'date_debut' => 'date',
            'date_fin' => 'date',
        ];
    }
}
