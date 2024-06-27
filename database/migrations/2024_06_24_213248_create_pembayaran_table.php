<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->unsignedInteger('id_pembeli');
            $table->unsignedInteger('id_metode_pembayaran');
            $table->decimal('jumlah', 15, 2);
            $table->string('id_transaksi')->unique();
            $table->timestamp('tanggal_pembayaran');
            $table->enum('status', ['belum dibayar', 'dibayar']); // Menambahkan kolom status
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_pembeli')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_metode_pembayaran')->references('id_metode_pembayaran')->on('metode_pembayaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
