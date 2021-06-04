<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('powerplays', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->bigInteger('kategori_id')->unsigned();
            $table->text('deskripsi');
            $table->integer('harga');
            $table->text('gambar');
            $table->text('gambar1');
            $table->text('gambar2');
            $table->string('link');
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('powerplays');
    }
}
