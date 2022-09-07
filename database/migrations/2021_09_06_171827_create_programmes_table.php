<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('title',50)->nullable();
            $table->string('type',50)->nullable();
            $table->date('from',70)->nullable();
            $table->date('to',70)->nullable();
            $table->text('details')->nullable();
            $table->string('category',70)->nullable();
            $table->string('picture',40)->nullable();
            $table->string('ministry',70)->nullable();
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
        Schema::dropIfExists('programmes');
    }
}
