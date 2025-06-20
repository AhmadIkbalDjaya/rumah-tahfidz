<?php

use App\Models\Student;
use App\Models\Surah;
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
        Schema::create("hifzs", function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->references("id")->on("students")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignIdFor(Surah::class)->references("id")->on("surahs")->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedInteger("verse_start");
            $table->unsignedInteger("verse_end");
            $table->unsignedInteger("review_count")->default(1);
            $table->string("score");
            $table->dateTime("recorded_at");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("hifzs");
    }
};
