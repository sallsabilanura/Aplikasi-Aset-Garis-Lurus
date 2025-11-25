<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiAsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_asets', function (Blueprint $table) {
            $table->bigIncrements('LokasiBarangID');
            $table->unsignedBigInteger('BarangID');
            $table->string('LokasiBarang');
            $table->string('Kuantitas');
            $table->string('Gambar')->nullable(); // kolom untuk upload foto barang
            $table->timestamps();

                $table->foreign('BarangID')->references('BarangID')->on('barangs')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasi_asets');
    }
}
