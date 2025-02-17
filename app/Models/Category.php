<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'name_eng', 'created_at', 'updated_at'];
    public $timestamps = true;

    public const CLOTHES_ID = 1;
    public const HATS_ID = 2;
    public const SHOES_ID = 3;
    public const HANDS_ID = 4;
    public const CLEAR_ID = 5;
    public const OTHER_ID = 6;

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'category_id', 'id');
    }
}
