<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admission extends Model
{
    protected $fillable = [
        'application_reference',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'class_applying_for',
        'previous_school',
        'guardian_name',
        'guardian_relationship',
        'guardian_email',
        'guardian_phone',
        'address',
        'status',
        'admin_notes',
        'document_path',
        'student_id',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
