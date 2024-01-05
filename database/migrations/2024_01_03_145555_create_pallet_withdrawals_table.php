<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalletWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abast_sitio5_withdrawals', function (Blueprint $table) {
            $table->increments('Id_withdrawal');
            $table->integer('id_pallet');
            $table->timestamp('withdrawal_date');
            $table->string('location');
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
        Schema::dropIfExists('abast_sitio5_withdrawals');
    }
}