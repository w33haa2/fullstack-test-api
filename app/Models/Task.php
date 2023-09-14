<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        // assign a user id
        static::creating(function ($model) {
            $model->user_id = auth('sanctum')->user()->id;
        });
    }
}
