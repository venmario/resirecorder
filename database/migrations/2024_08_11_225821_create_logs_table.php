<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('awb', 200);
            $table->foreignId('merchants_id')->constrained('merchants');
            $table->foreignId('ecoms_id')->constrained('ecoms');
            $table->foreignId('ekspedisis_id')->constrained('ekspedisis');
            $table->string('users_username', 20);
            $table->foreign('users_username')->references('username')->on('users');
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
        Schema::dropIfExists('logs');
    }
}
