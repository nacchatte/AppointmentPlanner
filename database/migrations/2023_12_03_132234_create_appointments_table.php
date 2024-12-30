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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('App_Id');
            $table->date('App_Date');
            $table->time('App_Time');
            $table->integer('App_Duration');
            $table->double('App_Price',10,2)->default(0);
            $table->string('App_Desc');
            $table->string('App_Status');
            $table->string('Customer_Id');
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
        Schema::dropIfExists('appointments');
    }
};
