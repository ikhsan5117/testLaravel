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
        Schema::table('ekyc_registrations', function (Blueprint $table) {
            $table->text('alamat_domisili')->nullable()->after('asal_sma');
            $table->string('provinsi')->nullable()->after('alamat_domisili');
            $table->string('kota_kabupaten')->nullable()->after('provinsi');
            $table->string('kecamatan')->nullable()->after('kota_kabupaten');
            $table->string('kode_pos', 6)->nullable()->after('kecamatan');
            $table->string('nama_ibu_kandung')->nullable()->after('kode_pos');
            $table->enum('sumber_informasi', ['sosmed', 'kerabat', 'informasi_kampus'])->nullable()->after('nama_ibu_kandung');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ekyc_registrations', function (Blueprint $table) {
            $table->dropColumn(['alamat_domisili', 'provinsi', 'kota_kabupaten', 'kecamatan', 'kode_pos', 'nama_ibu_kandung', 'sumber_informasi']);
        });
    }
};
