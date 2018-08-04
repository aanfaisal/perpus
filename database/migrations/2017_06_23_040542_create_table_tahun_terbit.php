<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTahunTerbit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_terbit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tahun');
            $table->timestamps();
        });

        // Set FK id_tahun di Buku
        Schema::table('buku',function(Blueprint $table){
            $table->foreign('id_tahun')
                 ->references('id')
                 ->on('tahun_terbit')
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
        Schema::dropIfExists('tahun_terbit');

        Schema::table('buku',function (Blueprint $table){
            $table->dropForeign('buku_id_tahun_foreign');
        });
    }
}
