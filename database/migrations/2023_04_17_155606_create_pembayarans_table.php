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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('pasien_id');
            $table->foreign('pasien_id')->references('id')->on('pasiens');

            $table->unsignedBigInteger('rekam_medis_id');
            $table->foreign('rekam_medis_id')->references('id')->on('rekam_medis');

            $table->string('alat_medis');
            $table->unsignedBigInteger('administrasi');
            $table->unsignedBigInteger('total_bayar');
            $table->enum('metode_pembayaran', ['Cash', 'Debit', 'Kredit']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
