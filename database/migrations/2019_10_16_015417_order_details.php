<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->Increments('id_order_details');
            $table->unsignedInteger('id_order');
            $table->foreign('id_order')->references('id_order')->on('order')->onDelete('CASCADE');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('CASCADE');
            $table->text('catatan')->nullable();
            $table->enum('status', ['Dikirim', 'Booking', 'Diambil']);
            $table->integer('ongkir');
            $table->integer('jumbel_produk');
            $table->integer('harga_produk');
            $table->integer('bobot_produk');
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
        Schema::dropIfExists('order_details');
    }
}
