<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_participants', function (Blueprint $table) {
            $table->id('training_participant_id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->dateTime('date_register')->nullable();


            $table->unsignedBigInteger('training_seminar_id');
            $table->foreign('training_seminar_id')->references('training_seminar_id')->on('training_seminars')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->tinyInteger('approval_status')->nullable()
                ->default(0);

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
        Schema::dropIfExists('training_participants');
    }
}
