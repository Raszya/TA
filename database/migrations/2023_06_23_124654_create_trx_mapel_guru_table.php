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
        Schema::create('trx_mapel_guru', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->unsignedBigInteger('id_mapel');
            $table->enum('is_aktif', ['0', '1']);
            $table->string('desc')->nullable();
            $table->string('kode_akses')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('nip')->references('nomer_induk')->on('gurus')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_mapel_guru');
    }
};
