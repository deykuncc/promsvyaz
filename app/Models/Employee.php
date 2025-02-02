<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';
    protected $fillable = [
        'gender_id',
        'department_id',
        'profession_id',
        'clothes_size_id',
        'shoes_size_id',
        'hats_size_id',
        'external_id',
        'last_name',
        'first_name',
        'middle_name',
        'height',
        'employment_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }

    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class, 'profession_id', 'id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function clothesSize(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'clothes_size_id', 'id');
    }

    public function shoesSize(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'shoes_size_id', 'id');
    }

    public function hatsSize(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'hats_size_id', 'id');
    }

    public function lastName(): Attribute
    {
        return Attribute::make(get: fn($val) => ucfirst($val), set: fn($val) => ucfirst($val));
    }

    public function firstName(): Attribute
    {
        return Attribute::make(get: fn($val) => ucfirst($val), set: fn($val) => ucfirst($val));
    }

    public function middleName(): Attribute
    {
        return Attribute::make(get: fn($val) => ucfirst($val), set: fn($val) => ucfirst($val));
    }

    public function height(): Attribute
    {
        return Attribute::make(get: fn($val) => (int)$val, set: fn($val) => (int)$val);
    }

    public function name(): string
    {
        return "{$this->last_name} {$this->first_name} {$this->middle_name}";
    }

    public function items(): HasMany
    {
        return $this->hasMany(EmployeeItem::class, 'employee_id', 'id');
    }
}
