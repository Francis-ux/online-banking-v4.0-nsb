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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('amount');
            $table->text('description')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('iban_code')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('withdrawal_method')->nullable();
            $table->string('beneficiary')->nullable();
            $table->string('reference_id');
            $table->string('type');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
