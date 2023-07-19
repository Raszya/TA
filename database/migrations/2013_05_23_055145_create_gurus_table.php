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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id('nomer_induk');
            $table->string('nama');
            $table->string('alamat');
            $table->string('jk');
            $table->string('notelp');
            $table->enum('is_aktif', ['0', '1']);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('nomer_induk', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
};
