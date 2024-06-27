<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetodePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metode_pembayaran', function (Blueprint $table) {
            $table->increments('id_metode_pembayaran');
            $table->string('nama_akun');
            $table->string('nama_bank');
            $table->string('nomor_rekening');
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
        Schema::dropIfExists('metode_pembayaran');
    }
}
