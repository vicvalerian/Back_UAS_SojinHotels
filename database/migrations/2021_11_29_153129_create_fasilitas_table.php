<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('barang'); // nama barang fasilitas
            $table->integer('jmlBarang'); // jumlah barang fasilitas min 1 (kasur, selimut, bantal)
            $table->double('biayaBarang'); // biaya barang fasilitas (215000, 50000, 35000)
            $table->string('email'); // email yang memesan barang fasilitas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fasilitas');
    }
}
