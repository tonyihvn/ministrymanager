<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followups', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->date('date')->nullable();
            $table->string('type')->nullable();
            $table->text('discussion')->nullable();
            $table->string('nextaction')->nullable();
            $table->date('nextactiondate')->nullable();
            $table->string('status')->nullable();

            $table->unsignedBigInteger('member')->index();
            $table->foreign('member')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('assigned_to')->index();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('followups');
    }
}
