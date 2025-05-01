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
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->foreignId('validator_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null')
                  ->after('status_validasi');
        });
    }
    
    public function down()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropForeign(['validator_id']);
            $table->dropColumn('validator_id');
        });
    }
};
