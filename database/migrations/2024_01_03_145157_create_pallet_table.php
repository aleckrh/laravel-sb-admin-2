<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abast_sitio5_pallet', function (Blueprint $table) {
            $table->increments('id');
            $table->string('OP');
            $table->boolean('pallet_status');
            $table->timestamp('creation_date');
            $table->string('procedence');
            $table->string('user_id');
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
        Schema::dropIfExists('abast_sitio5_pallet');
    }
}