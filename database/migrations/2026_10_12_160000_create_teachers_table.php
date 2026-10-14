<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_number')->unique();
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('email')->nullable()->unique();
            $table->string('phone', 30)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('qualification')->nullable();
            $table->string('specialization')->nullable();
            $table->string('assigned_class')->nullable();
            $table->string('employment_type')->default('full_time');
            $table->date('hire_date')->nullable();
            $table->string('status')->default('active');
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['assigned_class', 'status']);
            $table->index(['last_name', 'first_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
