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
        Schema::create("surahs", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("number")->unsigned();
            $table->integer("varse_count")->unsigned();
            $table->integer("juz_number")->unsigned();
            $table->string("meaning");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("surahs");
    }
};
