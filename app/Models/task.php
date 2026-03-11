<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $table = 'tasks';

    // task statuses used throughout the app
    public const STATUS_PENDING = 'pending';
    public const STATUS_STARTED = 'started';
    public const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'status',
    ];
}
