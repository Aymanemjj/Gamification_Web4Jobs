<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("events", function (Blueprint $table) {
            $table->id();
            $table->timestamp("happened_at");
            $table->string("event_type");
            $table->string("dedub_key");
            $table
                ->foreignId("metric_key_id")
                ->references("id")
                ->on("metric_keys");
            $table->foreignId("learner_id")->constrained();
            $table->foreignId("platform_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("events");
    }
};
