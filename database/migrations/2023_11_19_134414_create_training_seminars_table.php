<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_seminars', function (Blueprint $table) {
            $table->id('training_seminar_id');

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('user_id')->on('users')
            //     ->onUpdate('cascade')->onDelete('cascade');
            $table->string('seminar_title')->nullable();
            $table->text('seminar_desc')->nullable();
            $table->dateTime('date_from')->nullable();
            $table->dateTime('date_to')->nullable();
            $table->string('no_hours', 15)->nullable();
            $table->string('sponsored_by', 100)->nullable();
            $table->string('speaker', 100)->nullable();
            $table->string('attach_path')->nullable();
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
        Schema::dropIfExists('training_seminars');
    }
}
