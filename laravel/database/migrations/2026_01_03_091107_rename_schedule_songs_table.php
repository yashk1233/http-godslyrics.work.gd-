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

if (Schema::hasTable('schedule_songs') && !Schema::hasTable('scheduleSong')) {
            Schema::rename('schedule_songs', 'scheduleSong');
        }


        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

if (Schema::hasTable('scheduleSong') && !Schema::hasTable('schedule_songs')) {
            Schema::rename('scheduleSong', 'schedule_songs');
        }
    }
};
