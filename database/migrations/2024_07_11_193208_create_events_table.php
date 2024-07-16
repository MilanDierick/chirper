<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('event_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
        });

        Schema::create('class_levels', function (Blueprint $table) {
            $table->id();
            $table->integer('level')->unique();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('prerequisites')->nullable();
            $table->foreignId('status_id')->constrained('event_statuses');
            $table->integer('spots');
            $table->integer('spots_taken');
            $table->integer('waitlist');
            $table->integer('waitlist_taken');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->dateTime('grace');
            $table->string('address');
            $table->text('mail_subject');
            $table->text('mail_body');
            $table->tinyInteger('sorting')->default(1);
            $table->foreignId('author_id')->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });

        // pivot table for one-to-many relationship between events and class_levels
        Schema::create('event_class_level', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('class_level_id')->constrained('class_levels')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_class_level');
        Schema::dropIfExists('events');
        Schema::dropIfExists('class_levels');
        Schema::dropIfExists('event_statuses');
    }
};
