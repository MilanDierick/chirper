<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('organizer_name');
            $table->dropColumn('organizer_email');
            $table->dropColumn('organizer_phone');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('organizer_name')->after('grace');
            $table->string('organizer_email')->after('organizer_name');
            $table->string('organizer_phone')->after('organizer_email');
        });
    }
};
