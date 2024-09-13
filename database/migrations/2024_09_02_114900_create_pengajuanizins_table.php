<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('pengajuanizins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason');
            $table->string('type');
            $table->string('proof')->nullable();
            $table->string('status')->default('pending'); 
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('pengajuanizins');
    }
};
