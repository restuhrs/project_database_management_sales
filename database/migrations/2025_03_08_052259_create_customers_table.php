<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('salesman_id')->nullable();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('nomor_hp_1');
            $table->string('nomor_hp_2')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('tipe_pelanggan', ['first buyer', 'replacement', 'additional'])->nullable();
            $table->enum('jenis_pelanggan', ['retail', 'fleet'])->nullable();
            $table->string('pekerjaan')->nullable();
            $table->integer('tenor')->nullable();
            $table->date('tanggal_gatepass')->nullable();
            $table->string('model_mobil')->nullable();
            $table->string('nomor_rangka')->nullable();
            $table->string('sumber_data')->nullable();
            $table->enum('progress', ['DO', 'SPK', 'pending', 'reject', 'tidak valid' ])->nullable();
            $table->boolean('saved')->default(false);
            $table->text('alasan')->nullable();
            $table->string('old_salesman')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Relasi ke tabel branches
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('salesman_id')->references('id')->on('user')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
