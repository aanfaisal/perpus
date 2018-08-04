<?php

use Illuminate\Database\Seeder;

class penerbit_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i <90 ; $i++) { 
        	DB::table('penerbit')
        	-> insert([
        		'nm_penerbit'	=> $faker->company,
        		'tlpn'			=> $faker->e164PhoneNumber,
        		'alamat'		=> $faker->address,
        		'created_at'	=> date('Y-m-d H:i:s'),
        		'updated_at'	=> date('Y-m-d H:i:s'),
        		]);
        }
    }
}
