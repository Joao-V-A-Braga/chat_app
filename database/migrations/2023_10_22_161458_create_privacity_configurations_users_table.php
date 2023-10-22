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
        Schema::create('privacity_configurations_users', function (Blueprint $table) {
            $table
                ->foreignId('configuration_user_id')
                ->constrained('configurations_users')
                ->onDelete('cascade');
            $table->boolean('is_read_confirmation')->default(true);
            $table->string('last_seen_type', 40)->default('ALL'); // ONLY_FRINDS, ALL...
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('privacity_configurations_users', function (Blueprint $table) {
            $table
                ->dropConstrainedForeignId('configuration_user_id')
                ->constrained('configurations_users')
                ->onDelete('cascade');
        });
        Schema::dropIfExists('privacity_configurations_users');
    }
};
