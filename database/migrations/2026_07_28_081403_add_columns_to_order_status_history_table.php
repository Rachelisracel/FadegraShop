<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('order_status_history', function (Blueprint $table) {
            $table->string('old_status')->nullable()->after('status');
            $table->string('new_status')->nullable()->after('old_status');
            $table->unsignedBigInteger('changed_by')->nullable()->after('new_status');
        });
    }

    public function down()
    {
        Schema::table('order_status_history', function (Blueprint $table) {
            $table->dropColumn(['old_status', 'new_status', 'changed_by']);
        });
    }
};
