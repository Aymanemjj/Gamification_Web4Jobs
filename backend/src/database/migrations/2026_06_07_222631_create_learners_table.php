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
        Schema::create("learners", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("firstname");
            $table->string("lastname");
            $table->integer("age");
            $table->string("email");
            $table->string("password");
            $table->integer("xp");
            $table->foreignId("league_id")->constrained();
            $table->foreignId("group_id")->nullable()->constrained();
            $table->foreignId("center_id")->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("learners");
    }
};
