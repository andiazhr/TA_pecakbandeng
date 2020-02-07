<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->Increments('id_rating');
            $table->unsignedInteger('id_pelanggan');
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('users_pelanggan')->onDelete('CASCADE');
            $table->unsignedInteger('id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('CASCADE');
            $table->text('nilai');
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
        Schema::dropIfExists('rating');
    }
}
