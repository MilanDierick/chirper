<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('class_levels', function (Blueprint $table) {
            $table->id();
            $table->integer('level')->unique();
        });

        Schema::create('school_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
        });

        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->foreignId('school_type_id')->constrained('school_types');
        });

        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->date('date_of_birth');
            $table->foreignId('class_level_id')->constrained('class_levels');
            $table->string('information')->nullable();
            $table->boolean('special_needs');
            $table->boolean('media_consent');
            $table->foreignId('parent_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('school_id')->constrained('schools');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('children');
        Schema::dropIfExists('class_levels');
        Schema::dropIfExists('schools');
        Schema::dropIfExists('school_types');
    }
};
