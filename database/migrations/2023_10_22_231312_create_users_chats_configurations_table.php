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
        Schema::create('users_chats_configurations', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_silenced')->default(false);
            $table->boolean('is_fixed')->default(false);
            $table->text('backGroundImage')->nullable(true)->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_chats_configurations');
    }
};
