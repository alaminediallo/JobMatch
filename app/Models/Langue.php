<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Langue extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    /**
     * Les utilisateurs qui parlent cette langue.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'candidat_langue', relatedPivotKey: 'candidat_id')
            ->withPivot('niveau');
    }
}
