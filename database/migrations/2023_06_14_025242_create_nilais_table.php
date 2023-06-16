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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_jawaban');
            // $table->unsignedBigInteger('id_mapel');
            $table->string('nilai');
            $table->timestamps();
            // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_jawaban')->references('id')->on('jawabans')->onDelete('cascade');
            // $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilais');
    }
};
