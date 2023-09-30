<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataOrtuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata_ortu', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_pekerjaan_ayah');
            $table->foreign('id_pekerjaan_ayah')
                ->references('id')
                ->on('pekerjaan_ortu')
                ->onDelete('cascade');

            $table->unsignedBigInteger('id_pekerjaan_ibu');
            $table->foreign('id_pekerjaan_ibu')
                ->references('id')
                ->on('pekerjaan_ortu')
                ->onDelete('cascade');

            $table->unsignedBigInteger('id_penghasilan_ayah');
            $table->foreign('id_penghasilan_ayah')
                ->references('id')
                ->on('penghasilan_ortu')
                ->onDelete('cascade');

            $table->unsignedBigInteger('id_penghasilan_ibu');
            $table->foreign('id_penghasilan_ibu')
                ->references('id')
                ->on('penghasilan_ortu')
                ->onDelete('cascade');

            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->BigInteger('no_tlp');
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
        Schema::dropIfExists('biodata_ortu');
    }
}
