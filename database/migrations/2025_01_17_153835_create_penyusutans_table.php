<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyusutansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyusutans', function (Blueprint $table) {
            $table->bigIncrements('PenyusutanID');
            $table->unsignedBigInteger('AsetID');
            $table->unsignedBigInteger('user_id');
            $table->string('TahunPenyusutan');
            $table->decimal('NilaiAwal', 15,2);
            $table->decimal('PenyusutanTahunan', 15,2);
            $table->decimal('NilaiAkhir', 15,2);
            $table->timestamps();
            $table->foreign('AsetID')->references('AsetID')->on('asets')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyusutans');
    }
}
