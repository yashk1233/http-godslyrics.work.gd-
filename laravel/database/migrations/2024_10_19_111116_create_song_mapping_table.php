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
        Schema::create('song_mapping', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('song_id');
            $table->bigInteger('song_category_id');
            $table->bigInteger('song_language_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('song_mapping');
    }
};
