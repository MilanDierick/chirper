<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservation_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
        });

        foreach (['request', 'pending', 'confirmed', 'waitlist'] as $type) {
            DB::table('reservation_types')->insert(['type' => $type]);
        }

        Schema::table('reservations', function (Blueprint $table) {
            $table->foreignId('reservation_type_id')->after('id')->constrained('reservation_types');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['reservation_type_id']);
            $table->dropColumn('reservation_type_id');
        });

        Schema::dropIfExists('reservation_types');
    }
};
