<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_number')->unique();
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('class_name', 50);
            $table->string('guardian_name', 150);
            $table->string('guardian_email')->nullable();
            $table->string('guardian_phone', 30);
            $table->date('enrollment_date')->nullable();
            $table->string('status', 20)->default('active');
            $table->text('address')->nullable();
            $table->timestamps();

            $table->index(['class_name', 'status']);
            $table->index(['last_name', 'first_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
