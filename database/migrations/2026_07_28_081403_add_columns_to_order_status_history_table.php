<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_status_history', function (Blueprint $table) {
            $table->string('old_status')->nullable()->after('status');
            $table->string('new_status')->nullable()->after('old_status');
            $table->foreignId('changed_by')->nullable()->after('new_status')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('order_status_history', function (Blueprint $table) {
            $table->dropForeign(['changed_by']);
            $table->dropColumn(['old_status', 'new_status', 'changed_by']);
        });
    }
};