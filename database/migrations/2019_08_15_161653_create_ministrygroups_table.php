<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinistrygroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ministrygroups', function (Blueprint $table) {
            $table->id();
            $table->string('ministry_group_name',700)->nullable();
            $table->string('motto',70)->nullable();
            $table->string('logo',50)->nullable();
            $table->string('address',70)->nullable();
            $table->string('background',50)->nullable();
            $table->string('mode')->nullable();
            $table->string('color',30)->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });

        DB::table('ministrygroups')->insert(
            array(
                'ministry_group_name' => 'Ministry Manager',
                'user_id' => 1
            ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ministrygroups');
    }
}
