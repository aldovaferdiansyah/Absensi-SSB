<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingProfilesTable extends Migration
{

    public function up()
    {
        Schema::create('settingsprofiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_SSB');
            $table->string('alamat');
            $table->string('logo_SSB')->nullable(); 
            $table->string('profile_title')->nullable(); 
            $table->text('profile_content')->nullable(); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
