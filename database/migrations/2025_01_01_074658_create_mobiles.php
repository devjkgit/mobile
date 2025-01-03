<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiles', function (Blueprint $table) {
            $table->integer('id',11)->autoIncrement();
            $table->string('name')->nullable()->default('NULL');
            $table->string('phone_no',100)->nullable()->default('NULL');
            $table->string('company',100)->nullable()->default('NULL');
            $table->string('model')->nullable()->default('NULL');
            $table->string('battery_health')->nullable()->default('NULL');
            $table->string('imei')->nullable()->default('NULL');
            $table->string('id_proof')->nullable()->default('NULL');
            $table->integer('purchase_price')->nullable()->default(0);
            $table->integer('sell_price')->nullable()->default(0);
            $table->integer('profit')->nullable()->default(0);
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
        Schema::dropIfExists('mobiles');
    }
}
