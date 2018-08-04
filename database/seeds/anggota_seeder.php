<?php

use Illuminate\Database\Seeder;

class anggota_seeder extends Seeder
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
        	DB::table('anggota')
        	-> insert([
        		'nis'			=> $faker->unixTime($max = 'now'),
        		'nama_anggota'	=> $faker->name,
        		'tgl_lahir'		=> $faker->date($format = 'Y-m-d', $max = 'now'),
        		'telepon'		=> $faker->e164PhoneNumber,
        		'alamat'		=> $faker->address,
        		'created_at'	=> date('Y-m-d H:i:s'),
        		'updated_at'	=> date('Y-m-d H:i:s'),
        		]);
        }
    }
}
