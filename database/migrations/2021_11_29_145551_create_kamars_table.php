<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id(); //id kamar - auto inkremen
            $table->string('nama'); // nama pemesan reservasi kamar
            $table->string('nik'); // nik pemesan reservasi kamar
            $table->string('noTelp'); //no telp pemesan reservasi kamar
            $table->string('tipeKamar'); //tipe kamar (standard, deluxe, presidential)
            $table->double('biayaKamar'); //biaya kamar (300000, 400000, 500000)
            $table->string('email'); //email pemesan kamar
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
        Schema::dropIfExists('kamars');
    }
}
