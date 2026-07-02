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
            $table->string("event_type_id")->references("id")->on("event_types");
            $table->string("dedupe_key");
            $table
                ->foreignId("metric_key_id")
                ->references("id")
                ->on("metric_keys");
            $table->foreignId("user_id")->constrained();
            $table->foreignId("platform_id")->constrained();
            $table->boolean("accepted");
            $table->string("reason");
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
