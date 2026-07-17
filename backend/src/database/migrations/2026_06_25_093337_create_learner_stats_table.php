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
        Schema::create('user_stats', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->integer('xp')->default(0);
            $table->foreignId("league_id")->nullable()->constrained()->default(null);
            $table->foreignId("group_id")->nullable()->constrained()->default(null);
            $table->foreignId("center_id")->nullable()->constrained()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learner_stats');
    }
};
