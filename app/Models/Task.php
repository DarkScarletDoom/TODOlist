<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Task extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'completed'
    ];

    protected $casts = [
        'completed' => 'boolean'
    ];

    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';

    public static function getPriorities(): array
    {
        return [
            self::PRIORITY_LOW => 'Низкий',
            self::PRIORITY_MEDIUM => 'Средний',
            self::PRIORITY_HIGH => 'Высокий',
        ];
    }

    public static function scopeCompleted(): Builder
    {
        return Task::where('completed', true);
    }

    public static function scopeHighPriority(): Builder
    {
        return Task::where('priority', 'high');
    }

    public function getPriorityNameAttribute(): string
    {
        return self::getPriorities()[$this->priority] ?? 'Неизвестно';
    }
}
