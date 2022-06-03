<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('asunto');
            $table->string('des');
            $table->string('resol')->nullable();
            $table->bigInteger('id_pserv');
            $table->bigInteger('id_user_con');
            $table->foreign('id_pserv')->references('id')->on('pservicio');
            $table->foreign('id_user_con')->references('id')->on('users');
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
        Schema::dropIfExists('comentario');
    }
};
