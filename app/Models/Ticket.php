<?php

namespace App\Models;

use App\Enums\Priority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'attachment',
        'user_id',
        'department_id',
        'priority'
    ];

    public function getPriorityClasses(): string
    {
        $classes = 'inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium ';

        return match ($this->priority) {
            Priority::Low->value => $classes . 'bg-green-100 text-green-800',
            Priority::High->value => $classes . 'bg-yellow-100 text-yellow-800',
            Priority::Urgent->value => $classes . 'bg-red-100 text-red-800',
            default => $classes . 'bg-gray-200 text-gray-600',
        };
    }

    public function department()
    {   
    return $this->belongsTo(Department::class);
    }
}
