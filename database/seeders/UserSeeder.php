<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'username' => 'admin',
                'lname' => 'CYRELL',
                'fname' => 'SAYRE',
                'mname' => 'M',
                'sex' => 'MALE',

                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',

                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',

                'email' => 'admin@dev.com',
                'contact_no' => '09167789585',
                'role' => 'administrator',
                'password' => Hash::make('a')
            ],

            //FACULTY
            [
                'username' => 'junrey',
                'lname' => 'SANTARITA',
                'fname' => 'JUN REY',
                'mname' => 'P',
                'sex' => 'MALE',

                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',

                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',

                'email' => 'junrey@dev.com',
                'contact_no' => '09683014598',
                'role' => 'employee',
                'password' => Hash::make('a')
            ],

            [
                'username' => 'cj',
                'lname' => 'LENOGON',
                'fname' => 'CJ KEN',
                'mname' => 'P',
                'sex' => 'MALE',

                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',

                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',

                'email' => 'cj@dev.com',
                'contact_no' => '09683014598',
                'role' => 'point_person',
                'password' => Hash::make('a')
            ],


            [
                'username' => 'eman',
                'lname' => 'FUENTES',
                'fname' => 'EMMANUEL',
                'mname' => 'P',
                'sex' => 'MALE',

                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',

                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',

                'email' => 'eman@dev.com',
                'contact_no' => '09683014598',
                'role' => 'training_dev_officer',
                'password' => Hash::make('a')
            ],


        ];

        \App\Models\User::insertOrIgnore($data);
    }
}
