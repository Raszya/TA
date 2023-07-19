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
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_tahun');
            $table->string('nama');
            $table->string('alamat');
            $table->string('jk');
            $table->string('notelp');
            $table->enum('is_aktif', ['0', '1']);
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('cascade');
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('id_tahun')->references('id')->on('tahun')->onDelete('cascade');
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
