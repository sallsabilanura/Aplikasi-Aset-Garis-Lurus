<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asets', function (Blueprint $table) {
            $table->bigIncrements('AsetID');
            $table->unsignedBigInteger('KategoriID')->nullable(); // tambahkan nullable jika bisa kosong
            $table->unsignedBigInteger('user_id');
            $table->string('NamaAset');
            $table->string('KodeAset');
            $table->string('Dana');
            $table->string('Kuantitas');
            $table->string('Program');
            $table->decimal('NilaiPerolehan', 15,2);
            $table->decimal('NilaiResidu', 15,2);
            $table->string('MasaManfaat');
            $table->date('TanggalPerolehan');
            $table->string('LokasiAset');
            $table->string('Status');
            $table->timestamps();
            $table->foreign('KategoriID')->references('KategoriID')->on('kategori_asets')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asets');
    }
}
