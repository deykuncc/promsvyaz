<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemBrand extends Model
{
    protected $table = 'item_brands';
    protected $fillable = ['item_id', 'name', 'model', 'article'];
    public $timestamps = true;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
