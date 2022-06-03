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
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_serv');
            $table->bigInteger('id_dventa');
            $table->Integer('status');
            $table->Integer('scant');
            $table->decimal('stotal',$precision = 8, $scale = 2);
            $table->foreign('id_serv')->references('id')->on('servicio');
            $table->foreign('id_dventa')->references('id')->on('dventa');
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
        Schema::dropIfExists('carrito');
    }
};
