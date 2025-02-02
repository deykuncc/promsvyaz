<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'professions';
    protected $fillable = ['name', 'created_at', 'updated_at', 'deleted_at'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'profession_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProfessionItem::class, 'profession_id', 'id');
    }
}
