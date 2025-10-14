<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory as FakerFactory; // ✅ correct import
use App\Models\BarangayListModel;

class SeniorCitizenSeeder extends Seeder
{
    public function run()
    {
        $faker = FakerFactory::create(); // ✅ correct usage

        $barangayModel = new BarangayListModel();
        $barangayUnits = $barangayModel->findAll();

        $data = [];

        for ($i = 0; $i < 50; $i++) {
            $birthdate = $faker->dateTimeBetween('-100 years', '-60 years')->format('Y-m-d');
            $age = date('Y') - date('Y', strtotime($birthdate));

            $randomBU = $faker->randomElement($barangayUnits);

            $data[] = [
                'firstname'     => $faker->firstName,
                'lastname'      => $faker->lastName,
                'middle_name'   => $faker->lastName,
                'suffix'        => $faker->randomElement(['', 'Jr.', 'Sr.', 'III']),
                'sex'           => $faker->randomElement(['Male', 'Female']),
                'barangay'      => $randomBU['barangay'],
                'unit'          => $randomBU['unit'],
                'birthdate'     => $birthdate,
                'age'           => $age,
                'osca_id'       => strtoupper($faker->bothify('OSCA-####-??')),
                'remarks'       => $faker->randomElement(['Active', 'Deceased', 'Transferred']),
                'date_issued'   => $faker->date(),
                'date_applied'  => $faker->date(),
            ];
        }

        $this->db->table('masterlist')->insertBatch($data);
    }
}
