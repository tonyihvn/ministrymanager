<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('gender',7)->nullable();
            $table->string('dob',50)->nullable();
            $table->string('age_group',15)->nullable();
            $table->string('phone_number',30)->nullable();
            $table->string('email',50)->nullable();
            $table->text('about',120)->nullable();
            $table->string('address',130)->nullable();
            $table->string('location',40)->nullable();
            $table->string('house_fellowship',50)->nullable();
            $table->string('invited_by')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('ministry',50)->nullable();
            $table->string('status',30)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('role',30)->nullable();
            $table->foreignId('settings_id')->constrained('settings');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'name' => 'Ministry Manager',
                'role' => 'Super'
            ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
