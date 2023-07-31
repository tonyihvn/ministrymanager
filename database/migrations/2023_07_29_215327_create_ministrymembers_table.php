<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistrymembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministrymembers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id')->index();
            $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('ministry_id')->index();
            $table->foreign('ministry_id')->references('id')->on('ministries')->onDelete('cascade');

            $table->string('position',30)->nullable();



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
        Schema::dropIfExists('ministrymembers');
    }
}
