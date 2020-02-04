<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PendpPerHari extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendpperhari', function (Blueprint $table) {
            $table->Increments('id_pendpperhari');
            $table->string('kode_pendpperhari');
            $table->integer('total_pendpperhari');
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
        Schema::dropIfExists('pendpPerHari');
    }
}
