<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamanBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_buku', function (Blueprint $table) {
            $table->integer('id_buku')->unsigned()->index();
            $table->integer('id_peminjaman')->unsigned()->index();
            $table->timestamps();

            //SET PK
            $table->primary(['id_buku','id_peminjaman']);

            //Set FK peminjaman_buku   ---buku
            $table->foreign('id_buku')
                ->references('id')
                ->on('buku')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            //Set FK peminjaman_buku   ---peminjaman
            $table->foreign('id_peminjaman')
                ->references('id')
                ->on('peminjaman')
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
        Schema::dropIfExists('peminjaman_buku');
    }
}
