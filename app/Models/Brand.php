<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 * @method static findOrFail(mixed $input)
 */
class Brand extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
