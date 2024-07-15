<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        DB::table('event_statuses')->truncate();
        DB::table('event_statuses')->insert([
            ['status' => 'request'],
            ['status' => 'open'],
            ['status' => 'waitlist'],
            ['status' => 'full'],
            ['status' => 'cancelled'],
        ]);

        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('status_id')->nullable()->after('prerequisites');
        });

        $defaultStatusId = DB::table('event_statuses')->where('status', 'open')->value('id');
        DB::table('events')->update(['status_id' => $defaultStatusId]);

        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('status_id')->nullable(false)->change();
            $table->foreign('status_id')->references('id')->on('event_statuses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });
    }
};
