<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'teacher_number',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'qualification',
        'specialization',
        'assigned_class',
        'employment_type',
        'hire_date',
        'status',
        'address',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'hire_date' => 'date',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->first_name,
            $this->middle_name,
            $this->last_name,
        ])));
    }
}
