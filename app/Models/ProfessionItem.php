<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfessionItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profession_items';
    protected $fillable = [
        'profession_id',
        'item_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = true;


    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class, 'profession_id', 'id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
