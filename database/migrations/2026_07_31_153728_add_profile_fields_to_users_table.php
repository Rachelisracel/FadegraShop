<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Thêm các cột mới
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 15)->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender', 10)->nullable();
            }
            if (!Schema::hasColumn('users', 'identity_card')) {
                $table->string('identity_card', 20)->nullable();
            }
            if (!Schema::hasColumn('users', 'dob')) {
                $table->date('dob')->nullable();
            }
            if (!Schema::hasColumn('users', 'province_id')) {
                $table->string('province_id', 10)->nullable();
            }
            if (!Schema::hasColumn('users', 'district_id')) {
                $table->string('district_id', 10)->nullable();
            }
            if (!Schema::hasColumn('users', 'ward_id')) {
                $table->string('ward_id', 10)->nullable();
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'gender', 'identity_card', 'dob', 
                'province_id', 'district_id', 'ward_id', 'address'
            ]);
        });
    }
};