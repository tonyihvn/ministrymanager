<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            // Generate fields for a report model, here are the fields report title, subtitle, report_date, ministry_unit, details, written_by, remarks
            // Ministry will have a relationship with the ministry model
            $table->string('title', 100);
            $table->string('subtitle', 100)->nullable();
            $table->date('report_date')->nullable();
            $table->string('ministry_unit', 50)->nullable();
            $table->text('details')->nullable();
            $table->string('written_by', 50)->nullable();
            $table->string('remarks', 100)->nullable();
            $table->unsignedBigInteger('ministry_id')->index()->nullable();
            $table->foreign('ministry_id')->references('id')->on('ministries')->onDelete('cascade');
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
        Schema::dropIfExists('reports');
    }
}
