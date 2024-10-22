<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_backgrounds', function (Blueprint $table) {
            $table->id('ed_bg_id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('level')->nullable();
            $table->string('name_of_school')->nullable();
            $table->fullText('degree')->nullable(); //set to fulltext
            $table->string('period_att_from')->nullable();
            $table->string('period_att_to')->nullable();
            $table->integer('highest_level_unit')->default(0);
            $table->string('year_graduated')->nullable();
            $table->string('scholarship')->nullable();

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
        Schema::dropIfExists('educational_backgrounds');
    }
}
