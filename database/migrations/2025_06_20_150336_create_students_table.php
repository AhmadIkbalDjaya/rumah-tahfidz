<?php

use App\Models\Claass;
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
        Schema::create("students", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignIdFor(Claass::class)->nullable()->references("id")->on("claasses")->onDelete("set null")->onUpdate("cascade");
            $table->string("guardian_name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("students");
    }
};
