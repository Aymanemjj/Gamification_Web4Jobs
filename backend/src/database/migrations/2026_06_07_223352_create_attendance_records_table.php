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
        Schema::create("attendance_records", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean("attended");
            $table->foreignId("learner_id")->constrained();
            $table->foreignId("center_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("attendance_records");
    }
};
