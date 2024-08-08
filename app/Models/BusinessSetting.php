<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static updateOrCreate(array $array)
 * @method static where(string $string, $key)
 */
class BusinessSetting extends Model
{
    use HasFactory;


    protected $guarded = ['id'];
    protected $fillable = ['type','value'];


}
