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
        Schema::create('pservicio', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('tipo_ser');
            $table->text('url_com_dom');
            $table->text('url_logo');
            $table->string('rfc');
            $table->bigInteger('id_us');
            $table->foreign('id_us')->references('id')->on('users');
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
        Schema::dropIfExists('pservicio');
    }
};
