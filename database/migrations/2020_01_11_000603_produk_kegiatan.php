<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProdukKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_kegiatan', function (Blueprint $table) {
            $table->Increments('id_produk_kegiatan');
            $table->unsignedInteger('id_kegiatan');
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan')->onDelete('CASCADE');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('CASCADE');
            $table->integer('discount');
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
        Schema::dropIfExists('produk_kegiatan');
    }
}
