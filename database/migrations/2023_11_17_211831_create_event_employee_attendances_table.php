<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventEmployeeAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_employee_attendances', function (Blueprint $table) {
            $table->id('event_employee_attendance_id');

            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->text('img_description')->nullable();
            $table->string('img_path')->nullable();

            $table->string('remarks')->nullable();

            
            $table->tinyInteger('attendance_status')->default(0);
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
        Schema::dropIfExists('event_employee_attendances');
    }
}
