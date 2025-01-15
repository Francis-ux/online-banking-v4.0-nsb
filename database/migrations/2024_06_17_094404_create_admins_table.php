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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->boolean('status')->default(true);
            $table->string('registration_token')->nullable();
            $table->string('dial_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('live_chat')->nullable();
            $table->string('live_chat_id')->nullable();
            $table->string('smtp_user')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('smtp_host')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_encryption')->nullable();
            $table->string('btc_address')->nullable();
            $table->string('btc_qr_code')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
