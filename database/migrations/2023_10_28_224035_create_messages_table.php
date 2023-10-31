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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained();
            $table->text('text')->nullable(true);
            $table->string('media_type')->nullable(true);
            $table->string('media_link')->nullable(true);
            $table->timestamps();
            $table->foreignId('user_id');
            $table->boolean('active')->default(true);
            $table->boolean('is_edited')->default(false);
            $table->boolean('is_shered')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
