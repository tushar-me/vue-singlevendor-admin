<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static select(string $string, string $string1)
 */
class Variation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function variationOptions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VariationOption::class, 'variation_id');
    }


}
