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

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('prerequisites')->nullable();
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
            $table->string('classes');
            $table->string('sorting');
            $table->foreignId('author_id')->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_statuses');
    }
};
