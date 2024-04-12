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
                'designation' => 'staff',
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
                'designation' => 'staff',
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
                'designation' => 'staff',
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
                'role' => 'training_officer',
                'designation' => 'staff',
                'password' => Hash::make('a')
            ],











            [
                'username' => 'reynaldo',
                'lname' => 'BUNAG',
                'fname' => 'REYNALDO',
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
                'email' => 'reynaldo@dev.com',
                'contact_no' => '09683014598',
                'role' => 'employee',
                'designation' => 'staff',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'ramon',
                'lname' => 'BUENAVENTURA',
                'fname' => 'RAMON',
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
                'email' => 'ramon@dev.com',
                'contact_no' => '09683014598',
                'role' => 'employee',
                'designation' => 'faculty',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'romel',
                'lname' => 'CATAPANG',
                'fname' => 'ROMEL',
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
                'email' => 'romel@dev.com',
                'contact_no' => '09683014598',
                'role' => 'employee',
                'designation' => 'faculty',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'clarissa',
                'lname' => 'GUEVARA',
                'fname' => 'CLARISSA',
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
                'email' => 'clarissa@dev.com',
                'contact_no' => '09683014598',
                'role' => 'employee',
                'designation' => 'faculty',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'juliet',
                'lname' => 'GUEVARA',
                'fname' => 'JULIET',
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
                'email' => 'juliet@dev.com',
                'contact_no' => '09683014598',
                'role' => 'employee',
                'designation' => 'faculty',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'mabel',
                'lname' => 'VULLACRUZ',
                'fname' => 'MABEL',
                'mname' => 'P',
                'sex' => 'FEMALE',
                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',
                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',
                'email' => 'mabel@dev.com',
                'contact_no' => '09683014598',
                'role' => 'employee',
                'designation' => 'faculty',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'choa',
                'lname' => 'SANTOS',
                'fname' => 'CHOA',
                'mname' => 'P',
                'sex' => 'FEMALE',
                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',
                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',
                'email' => 'choa@dev.com',
                'contact_no' => '09683014598',
                'role' => 'employee',
                'designation' => 'faculty',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'mj',
                'lname' => 'TAGALOG',
                'fname' => 'MERRY JEN',
                'mname' => 'P',
                'sex' => 'FEMALE',
                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',
                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',
                'email' => 'mj@dev.com',
                'contact_no' => '09683014598',
                'role' => 'employee',
                'designation' => 'faculty',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'cara',
                'lname' => 'ESPANA',
                'fname' => 'CARA',
                'mname' => 'P',
                'sex' => 'FEMALE',
                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',
                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',
                'email' => 'cara@dev.com',
                'contact_no' => '09683014598',
                'role' => 'employee',
                'designation' => 'faculty',
                'password' => Hash::make('a')
            ],
            [
                'username' => 'jane',
                'lname' => 'ARABEJO',
                'fname' => 'JANE',
                'mname' => 'P',
                'sex' => 'FEMALE',
                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',
                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',
                'email' => 'jane@dev.com',
                'contact_no' => '09683014598',
                'role' => 'record_officer',
                'designation' => 'staff',
                'password' => Hash::make('a')
            ],


        ];

        \App\Models\User::insertOrIgnore($data);
    }
}
