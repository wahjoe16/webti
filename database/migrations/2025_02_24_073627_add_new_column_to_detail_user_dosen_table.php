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
        Schema::table('detail_user_dosen', function (Blueprint $table) {
            $table->bigInteger('kelompok_keahlian_id')->unsigned();
            $table->foreign('kelompok_keahlian_id')->references('id')->on('kelompok_keahlian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_user_dosen', function (Blueprint $table) {
            $table->dropForeign('detail_user_dosen_kelompok_keahlian_id_foreign');
            $table->dropColumn('kelompok_keahlian_id');
        });
    }
};
