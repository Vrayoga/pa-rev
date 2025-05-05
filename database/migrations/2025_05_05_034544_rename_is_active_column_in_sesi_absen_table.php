<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sesi_absen', function (Blueprint $table) {
            $table->renameColumn('is-active', 'is_active');
        });
    }

    public function down()
    {
        Schema::table('sesi_absen', function (Blueprint $table) {
            $table->renameColumn('is_active', 'is-active');
        });
    }
};
