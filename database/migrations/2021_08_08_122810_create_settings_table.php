<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('ministry_name',100)->nullable();
            $table->string('motto',100)->nullable();
            $table->string('logo',50)->nullable();
            $table->string('address',100)->nullable();
            $table->string('background',50)->nullable();
            $table->string('mode')->nullable();
            $table->string('color',30)->nullable();
            $table->foreignId('ministrygroup_id')->constrained('ministrygroups')->nullable();
            $table->foreignId('user_id')->constrained('users')->nullable();;

            $table->timestamps();

        });

        DB::table('settings')->insert(
            array(
                'ministry_name' => 'Ministry Manager',
                'motto' => 'Ministry Management System',
                'logo' => 'logo-dark.png',
                'background' => 'login-bg.jpg',
                'mode' => 'Active',
                'address' => 'Church Address',
                'color' => '',
                'user_id' => 1,
                'ministrygroup_id' => 1

            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
