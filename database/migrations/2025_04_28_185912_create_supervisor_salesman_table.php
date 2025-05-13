<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('supervisor_salesman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('salesman_id');
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('supervisor_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('salesman_id')->references('id')->on('user')->onDelete('cascade');

            // Unique constraint
            $table->unique(['supervisor_id', 'salesman_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('supervisor_salesman');
    }
};
