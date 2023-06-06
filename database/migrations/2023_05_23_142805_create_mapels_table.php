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
        Schema::create('mapels', function (Blueprint $table) {
            $table->id('id_mapel');
            $table->unsignedBigInteger('id_user');
            $table->string('nama');
            $table->string('kode_akses');
            $table->string('desc');
            $table->enum('status', ['0', '1']);
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapels');
    }
};
