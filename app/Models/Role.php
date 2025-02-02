<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name'];
    public $timestamps = true;

    const NAMES = [
        'admin' => 'Администратор',
        'employee' => "Сотрудник"
    ];

    public function name(): Attribute
    {
        return Attribute::make(get: fn($val) => self::NAMES[$val] ?? $val);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
