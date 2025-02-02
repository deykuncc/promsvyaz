<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'departments';
    protected $fillable = ['name', 'created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;


    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'department_id', 'id');
    }
}
