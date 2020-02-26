<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersPelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_pelanggan', function (Blueprint $table) {
            $table->Increments('id_pelanggan');
            $table->string('nama_pelanggan', 40);
            $table->string('username', 25)->unique();
            $table->string('email_pelanggan', 35)->unique();
            $table->string('phone_number', 25);
            $table->string('password');
            $table->string('foto_profil', 100)->nullable();
            $table->text('bio')->nullable();
            $table->enum('status', ['1', '0']);
            $table->rememberToken();
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
