<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'kepala_cabang', 'supervisor', 'salesman']);
            $table->enum('status', ['aktif', 'nonaktif'])->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);  // Hapus foreign key dengan benar
        });

        Schema::dropIfExists('user');
    }
};
