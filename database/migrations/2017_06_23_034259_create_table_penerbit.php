<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePenerbit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerbit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nm_penerbit',30);
            $table->string('tlpn',15)->nullable();
            $table->string('alamat',70)->nullable();
            $table->timestamps();
        });

        // Set FK id_penerbit di Buku
        Schema::table('buku',function(Blueprint $table){
            $table->foreign('id_penerbit')
                 ->references('id')
                 ->on('penerbit')
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
        Schema::dropIfExists('penerbit');

        Schema::table('buku',function (Blueprint $table){
            $table->dropForeign('buku_id_penerbit_foreign');
        });
    }
}
