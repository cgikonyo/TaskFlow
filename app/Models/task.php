<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected static function boot()
    {
        parent::boot();

        // auto-assign task_number when creating a new task
        static::creating(function ($model) {
            if (!$model->task_number && $model->user_id) {
                $maxTaskNumber = Task::where('user_id', $model->user_id)->max('task_number');
                $model->task_number = ($maxTaskNumber ?? 0) + 1;
            }
        });
    }

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
        'task_number',
    ];
}
