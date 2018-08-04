<?php

use Illuminate\Database\Seeder;

class klasifikasi_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i <50 ; $i++) { 
        	DB::table('klasifikasi')
        	-> insert([
        		'tahun'			=> $faker->year($max = 'now'),
        		'created_at'	=> date('Y-m-d H:i:s'),
        		'updated_at'	=> date('Y-m-d H:i:s'),
        		]);
        }
    }
}
