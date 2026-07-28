<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bổ sung các cột order_code, subject, status cho bảng contacts đã tồn tại.
     * Bảng contacts thực tế đã có các cột id, user_id, full_name, phone_number, email, message, reply, created_at, updated_at.
     */
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'order_code')) {
                $table->string('order_code')->nullable()->after('phone_number');
            }
            if (!Schema::hasColumn('contacts', 'subject')) {
                $table->string('subject')->nullable()->after('order_code');
            }
            if (!Schema::hasColumn('contacts', 'status')) {
                $table->string('status')->default('pending')->after('message');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $columns = [];
            foreach (['order_code', 'subject', 'status'] as $col) {
                if (Schema::hasColumn('contacts', $col)) {
                    $columns[] = $col;
                }
            }
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};