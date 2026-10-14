<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_number',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'class_name',
        'guardian_name',
        'guardian_email',
        'guardian_phone',
        'enrollment_date',
        'status',
        'address',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'enrollment_date' => 'date',
        ];
    }
}