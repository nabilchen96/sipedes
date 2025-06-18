<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('no_rekening')->nullable();
            $table->string('id_bank')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('no_sk')->nullable();
            $table->string('siltap')->nullable();
            $table->string('potongan_bpjs')->nullable();
            $table->string('tunjangan')->nullable();
            $table->date('tmt_mulai_bertugas')->nullable();
            $table->date('tmt_berhenti_bertugas')->nullable();
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
        Schema::dropIfExists('pegawais');
    }
}
