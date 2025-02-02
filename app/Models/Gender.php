<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gender extends Model
{
    use HasFactory;

    protected $table = 'genders';
    protected $fillable = ['name', 'created_at', 'updated_at'];
    public $timestamps = true;

    public const NAMES = [
        'male' => 'Мужской',
        'female' => 'Женский'
    ];

    public function name(): Attribute
    {
        return Attribute::make(get: fn($val) => self::NAMES[$val] ?? $val, set: fn($val) => $val);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'gender_id', 'id');
    }
}
