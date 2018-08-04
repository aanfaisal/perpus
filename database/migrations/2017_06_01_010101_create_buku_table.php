<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('id_penulis')->unsigned();
            $table->integer('id_penerbit')->unsigned();
            $table->integer('id_tahun')->unsigned();
            $table->string('deskripsi',50)->nullable();  
            $table->integer('jumlah');     
            $table->integer('stok');
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
         Schema::drop('buku');
    }
}

