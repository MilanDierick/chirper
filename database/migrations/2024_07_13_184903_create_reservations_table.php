<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservation_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_type_id');
            $table->foreignId('child_id');
            $table->foreignId('event_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('reservation_types');
    }
};
