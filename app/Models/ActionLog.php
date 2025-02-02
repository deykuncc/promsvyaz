<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActionLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'action_logs';

    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public $timestamps = true;

    public const DELETE = 'delete';
    public const UPDATE = 'update';
    public const STORE = 'store';

    public const ITEM = 'Item';
    public const EMPLOYEE = 'Employee';
    public const PROFESSION = 'Profession';
    public const USER = 'User';

}
