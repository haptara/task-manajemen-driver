<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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

            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('board_id');
            $table->unsignedBigInteger('assigned_driver_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->string('starting_from')->nullable();
            $table->string('finished_in')->nullable();
            $table->integer('estimated_duration'); // in minutes
            $table->integer('duration'); // in minutes
            $table->enum('status', ['Urgent', 'High Priority', 'Normal Priority', 'Low Priority'])->nullable();
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
            $table->foreign('assigned_driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->softDeletes();

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
};
