<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{

    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id(); 
            $table->string('heading'); 
            $table->text('description'); 
            $table->timestamps(); 
        });
    }


    public function down()
    {
        Schema::dropIfExists('information');
    }
}
