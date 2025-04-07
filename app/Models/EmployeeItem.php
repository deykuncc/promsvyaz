<?php

namespace App\Models;

use App\Enums\ConditionType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employee_items';
    protected $fillable = ['employee_id', 'item_id', 'brand_id', 'size_id', 'quantity', 'quantity_type', 'received', 'expiry_date', 'usage_months', 'is_active', 'issued_date', 'created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    public function untilAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value != null ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d.m.Y') : "До износа",
        );
    }

    public function untilAtOrig(): ?string
    {
        return $this->attributes['expiry_date'] ?? null;
    }

    public function quantityType(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ConditionType::getValue($value),
        );
    }

    public function quantityTypeOrig(): int
    {
        return $this->attributes['quantity_type'] ?? 0;
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(ItemBrand::class, 'brand_id', 'id');
    }
}
