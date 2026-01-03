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
        Schema::create('song_master', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('song_title');
            // $table->bigInteger('song_category');
            // $table->bigInteger('song_language');
            $table->json('song_para');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('song_master');
    }
};
