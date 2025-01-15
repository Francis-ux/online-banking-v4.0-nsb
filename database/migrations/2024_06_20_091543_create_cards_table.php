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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->boolean('type');
            $table->string('residential_address');
            $table->string('registration_token');
            $table->string('phone');
            $table->string('email');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('status')->default(0);
            $table->date('date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
