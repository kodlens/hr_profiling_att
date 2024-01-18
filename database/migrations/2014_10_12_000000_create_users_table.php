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
            $table->id('user_id');
            $table->string('username', 10)->unique();
            $table->string('lname', 100);
            $table->string('fname', 100);
            $table->string('mname', 100)->nullable();
            $table->string('suffix', 4)->nullable();
            $table->date('date_birth')->nullable();
            $table->string('place_birth', 150)->nullable();

            $table->string('sex', 20)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('civil_status_others', 30)->nullable();

            $table->string('height', 10)->nullable();
            $table->string('weight', 10)->nullable();
            $table->string('blood_type', 10)->nullable();
            $table->string('gsis', 30)->nullable();
            $table->string('pagibig', 20)->nullable();
            $table->string('philhealth', 20)->nullable();
            $table->string('sss', 20)->nullable();
            $table->string('tin', 20)->nullable();
            $table->string('agency_idno', 100)->nullable();

            $table->string('citizenship', 50)->nullable();
            $table->string('dual_citizenship', 50)->nullable();
            $table->string('select_citizenship', 50)->nullable();

            $table->string('res_province', 100)->nullable();
            $table->string('res_city', 100)->nullable();
            $table->string('res_barangay', 100)->nullable();
            $table->string('res_street', 100)->nullable();
            $table->string('res_houseno_blockno', 100)->nullable();
            $table->string('res_zipcode', 10)->nullable();

            $table->string('per_province', 100)->nullable();
            $table->string('per_city', 100)->nullable();
            $table->string('per_barangay', 100)->nullable();
            $table->string('per_street', 100)->nullable();
            $table->string('per_houseno_blockno', 100)->nullable();
            $table->string('per_zipcode', 10)->nullable();

            $table->string('tel_no', 20)->nullable();
            $table->string('contact_no', 20)->nullable();
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();

            //spouse
            $table->string('spouse_surname', 100)->nullable();
            $table->string('spouse_fname', 100)->nullable();
            $table->string('spouse_mname', 100)->nullable();
            $table->string('spouse_suffix', 10)->nullable();
            $table->string('spouse_occupation', 30)->nullable();

            $table->string('business_name', 100)->nullable();
            $table->string('business_address', 100)->nullable();
            $table->string('business_contact_no', 30)->nullable();

            $table->string('father_surname', 100)->nullable();
            $table->string('father_fname', 100)->nullable();
            $table->string('father_mname', 100)->nullable();
            $table->string('father_suffix', 10)->nullable();

            $table->string('mother_maiden_name', 100)->nullable();
            $table->string('mother_fname', 100)->nullable();
            $table->string('mother_mname', 100)->nullable();
            $table->string('mother_suffix', 10)->nullable();

            $table->string('role', 30)->nullable();

            $table->tinyInteger('related_with_third_degree')->nullable();

            $table->tinyInteger('related_with_fourth_degree')->nullable();
            $table->string('related_with_fourth_degree_yes', 100)->nullable();

            $table->tinyInteger('is_guilty_administrative_offense')->nullable();
            $table->string('is_guilty_administrative_offense_yes')->nullable();

            $table->tinyInteger('is_criminally_charge')->nullable();
            $table->string('is_criminally_charge_yes')->nullable();

            $table->string('date_filed', 50)->nullable();
            $table->string('case_status', 100)->nullable();

            $table->tinyInteger('is_convicted')->nullable();
            $table->string('is_convicted_yes')->nullable();

            $table->tinyInteger('is_separated')->nullable();
            $table->string('is_separated_yes_details')->nullable();

            $table->tinyInteger('is_candidate_election')->nullable();
            $table->string('is_candiadte_election_yes')->nullable();

             $table->tinyInteger('is_immigrant')->nullable();
            $table->string('is_immigrant_yes')->nullable();

            $table->tinyInteger('is_resigned')->nullable();
            $table->string('is_resigned_yes')->nullable();

            $table->tinyInteger('is_indigenous')->nullable();
            $table->string('is_indigenous_yes')->nullable();

            $table->tinyInteger('is_disable')->nullable();
            $table->string('is_disable_id_no')->nullable();

            $table->tinyInteger('is_solo_parent')->nullable();
            $table->string('is_solo_parent_yes')->nullable();

            $table->tinyInteger('is_archive')->nullable()->default(0);
            $table->unsignedBigInteger('engagement_status_id')
                ->default(0)
                ->nullable();
           
            $table->tinyInteger('is_approve')->nullable()->default(0);


            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
