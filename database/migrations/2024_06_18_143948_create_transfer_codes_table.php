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
        Schema::create('transfer_codes', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('code');
            $table->string('verification_code_id');
            $table->string('transfer_reference_id');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('order_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_codes');
    }
};
