<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousefellowhipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housefellowhips', function (Blueprint $table) {
            $table->id();
            $table->string('name',70);
            $table->string('location',70)->nullable();
            $table->string('address',75)->nullable();
            $table->string('leader',50)->nullable();
            $table->text('about')->nullable();
            $table->text('activities')->nullable();
            $table->foreignId('settings_id')->constrained();
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
        Schema::dropIfExists('housefellowhips');
    }
}
