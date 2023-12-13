<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Position
 *
 * This class represents a position in a company.
 */
class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

}
