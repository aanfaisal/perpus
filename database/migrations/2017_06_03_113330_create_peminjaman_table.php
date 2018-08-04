<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            // buat tabel peminjaman
            $table->increments('id');
            $table->string('kode',7);
            $table->integer('id_anggota')->unsigned();
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->timestamps();

            // Set FK id_anggota
            $table->foreign('id_anggota')
                    ->references('id')
                    ->on('anggota')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');


            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
