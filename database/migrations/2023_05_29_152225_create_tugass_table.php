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
        Schema::create('tugass', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bab');
            $table->string('dir_tugas')->nullable();
            $table->dateTime('deadline');
            $table->enum('jenisTugas', ['1', '2']);
            $table->string('desc');
            $table->timestamps();

            $table->foreign('id_bab')->references('id')->on('babs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugass');
    }
};
