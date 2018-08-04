<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenulis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penulis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_penulis',30);
            $table->string('tlpn',15)->nullable();
            $table->string('alamat',70)->nullable();
            $table->timestamps();
        });

        // Set FK id_penerbit di Buku
        Schema::table('buku',function(Blueprint $table){
            $table->foreign('id_penulis')
                 ->references('id')
                 ->on('penulis')
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
        Schema::dropIfExists('penulis');

        Schema::table('buku',function (Blueprint $table){
            $table->dropForeign('buku_id_penulis_foreign');
        });
    }
}
