<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->date('date')->nullable();
            $table->string('category',70)->nullable();
            $table->text('activities')->nullable();
            $table->string('status')->nullable();
            $table->string('assigned_to',70)->nullable();
            $table->string('member',50)->nullable();
            $table->foreignId('settings_id')->constrained('settings');
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
        Schema::dropIfExists('tasks');
    }
}
