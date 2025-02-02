<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sizes';
    protected $fillable = ['size', 'type', 'created_at', 'updated_at', 'deleted_at'];

    public const CLOTHES = 'clothes';
    public const SHOES = 'shoes';
    public const HATS = 'hats';
    public const TYPES = [
        'clothes' => 'Одежды',
        'shoes' => 'Обуви',
        'hats' => 'Головного убора',
    ];

    public function type(): Attribute
    {
        return Attribute::make(get: fn($val) => self::TYPES[$val] ?? $val);
    }

    public function typeOrig(): string
    {
        return $this->attributes['type'] ?? '';
    }
}
