<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMintsTable extends Migration
{
    /**
     * Run the migrations.
     * Merchant's integrations table
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mints', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('handle');
            $table->string('adapter');
            $table->boolean('active')->default(true);
            $table->bigInteger('merchant_id');
            $table->bigInteger('integration_id');
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
        Schema::dropIfExists('mints');
    }
}
