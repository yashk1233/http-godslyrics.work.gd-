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
        Schema::table('schedule_song', function (Blueprint $table) {
    
		if (!Schema::hasColumn('scheduleSong', 'song_id')) {
                $table->integer('song_id')->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedule_song', function (Blueprint $table) {
            //

		if (Schema::hasColumn('scheduleSong', 'song_id')) {
                $table->dropColumn('song_id');
            }
	});
    }
};
