<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->restrictOnDelete();

            $table->string('academic_session', 20);
            $table->string('term', 20);

            $table->decimal('ca_score', 5, 2)->default(0);
            $table->decimal('exam_score', 5, 2)->default(0);
            $table->decimal('total_score', 5, 2)->default(0);

            $table->string('grade', 2)->nullable();
            $table->string('remark', 30)->nullable();
            $table->text('teacher_comment')->nullable();

            $table->timestamps();

            $table->unique(
                [
                    'student_id',
                    'subject_id',
                    'academic_session',
                    'term',
                ],
                'student_result_unique_term'
            );

            $table->index(['academic_session', 'term']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_results');
    }
};
