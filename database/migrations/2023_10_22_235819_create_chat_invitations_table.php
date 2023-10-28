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
        Schema::create('chat_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained();
            $table->boolean('active')->default(true);
            $table->dateTimeTz('expiration')->nullable(true);
            $table->text('link')->nullable(true);
            $table->foreignId('destiny')->nullable(true)->constrained('users');
            $table->foreignId('sender')->nullable(true)->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_invitations');
    }
};
