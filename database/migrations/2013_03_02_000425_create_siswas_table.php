<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id('nis');
            $table->unsignedBigInteger('id_jurusan');
            $table->string('nama');
            $table->string('alamat');
            $table->string('jk');
            $table->string('notelp');
            $table->timestamps();
            $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('Restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};
