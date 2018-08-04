<?php

use Illuminate\Database\Seeder;

class penulis_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i <800 ; $i++) { 
        	DB::table('penulis')
        	-> insert([
        		'nm_penulis'	=> $faker->name,
        		'tlpn'			=> $faker->e164PhoneNumber,
        		'alamat'		=> $faker->address,
        		'created_at'	=> date('Y-m-d H:i:s'),
        		'updated_at'	=> date('Y-m-d H:i:s'),
        		]);
        }
    }
}
