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
        });
    }
};
