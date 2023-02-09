<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_codes', function (Blueprint $table) {
            $table->id();
            $table->boolean('token_enviado');
            $table->timestamp('expira_em');
            $table->string('token');
            $table->unsignedBigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->ipAddress('ip_rede');
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
        Schema::dropIfExists('access_codes');
    }
}
