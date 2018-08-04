<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function(Blueprint $table){
            $table->increments('id');
            $table->string('nis',10);
            $table->string('nama_anggota',50);
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin',['L','P']);
            $table->string('telepon',12);
            $table->string('foto')->nullable();
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
         Schema::dropIfExists('anggota');
    }
}
