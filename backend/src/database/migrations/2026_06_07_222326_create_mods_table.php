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
        Schema::create("mods", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("firstname");
            $table->string("lastname");
            $table->integer("age");
            $table->string("email");
            $table->string("password");
            $table->foreignId("role_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("mods");
    }
};
