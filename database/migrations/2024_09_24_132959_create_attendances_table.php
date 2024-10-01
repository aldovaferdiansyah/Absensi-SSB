<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('role');
            $table->enum('type', ['latihan', 'pertandingan']);
            $table->timestamp('arrival_at')->nullable();
            $table->string('status_arrival')->nullable();
            $table->timestamp('departure_at')->nullable();
            $table->string('status_departure')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
