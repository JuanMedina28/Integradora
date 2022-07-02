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
        Schema::table('users', function (Blueprint $table) {
            $table->text('url_img_us')->nullable();
            $table->string('apaterno', 50)->nullable()->after('name');
            $table->string('amaterno',50)->nullable()->after('apaterno');
            $table->string('status')->nullable();
            $table->string('tipo_us')->nullable()->after('amaterno');
            $table->integer('pvez')->nullable();
            $table->string('celular')->nullable();
            $table->string('calleyn')->nullable();
            $table->string('n_iden')->nullable();
            $table->string('municipio')->nullable();
            $table->integer('cp')->nullable();
            $table->string('estado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('url_img_us');
            $table->dropColumn('apaterno');
            $table->dropColumn('amaterno');
            $table->dropColumn('status');
            $table->dropColumn('tipo_us');
            $table->dropColumn('pvez');
            $table->dropColumn('celular');
            $table->dropColumn('calleyn');
            $table->dropColumn('n_iden');
            $table->dropColumn('municipio');
            $table->dropColumn('cp');
            $table->dropColumn('estado');
        });
    }
};
