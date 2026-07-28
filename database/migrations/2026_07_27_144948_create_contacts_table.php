<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // Tự động nhận diện nếu đăng nhập
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('order_code')->nullable(); // Mã đơn hàng (nếu có)
            $table->string('subject')->nullable();    // Tiêu đề
            $table->text('message');                  // Nội dung phản hồi
            $table->enum('status', ['pending', 'processing', 'resolved'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
