<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_attendees', function (Blueprint $table) {
            $table->id('training_attendee_id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->dateTime('datetime_scanned')->nullable();


            $table->unsignedBigInteger('training_seminar_id');
            $table->foreign('training_seminar_id')->references('training_seminar_id')->on('training_seminars')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('attendance_status', 10)->nullable();

                
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
        Schema::dropIfExists('training_attendees');
    }
}
