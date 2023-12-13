<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Company
 *
 * Represents a company in the system.
 *
 * @package App\Models
 */
class Company extends Model
{
    use HasFactory;

    const  PAGE = 1;
    const PER_PAGE = 10;

    protected $fillable = [
        'name',
        'address'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class);
    }

    /**
     * @param Builder $query
     * @param string|null $search
     * @return void
     */
    public function scopeSearch(Builder $query, ?string $search = null): void
    {
        if (! empty($search)) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('address', 'LIKE', "%{$search}%");
        }
    }
}
