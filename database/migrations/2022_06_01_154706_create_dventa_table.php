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
        Schema::create('dventa', function (Blueprint $table) {
            $table->id();
            $table->string('no_venta');
            $table->date('fecha');
            $table->decimal('total',$precision = 8, $scale = 2);
            $table->Integer('status');
            $table->Integer('cant');
            $table->bigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('dventa');
    }
};
