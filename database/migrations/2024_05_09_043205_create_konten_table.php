<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontenTable extends Migration
{
    public function up()
    {
        Schema::create('konten', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->json('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('konten');
    }
}
