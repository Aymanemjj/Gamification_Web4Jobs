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
        Schema::create("metric_keys", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("platform_id")->constrained();
            $table->string("name");
            $table->json("rules");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("metric_keys");
    }
};
