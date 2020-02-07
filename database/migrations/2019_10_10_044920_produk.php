<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Produk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->Increments('id_produk');
            $table->unsignedInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_produk')->onDelete('CASCADE');
            $table->unsignedInteger('id_stok')->nullable();
            $table->foreign('id_stok')->references('id_stok')->on('stok')->onDelete('CASCADE')->nullable();
            $table->string('nama_produk', 200);
            $table->string('deskripsi_produk', 200);
            $table->string('gambar_produk', 100);
            $table->integer('harga_produk');
            $table->enum('status', ['0', '1']);
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
        Schema::dropIfExists('users_pelanggan');
    }
}
