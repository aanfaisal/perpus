<?php

use Illuminate\Database\Seeder;

class buku_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i <9000 ; $i++) { 
        	DB::table('buku')
        	-> insert([
        		'judul'			=> $faker->name,
        		'id_penulis'	=> $faker->numberBetween(1,800),
        		'id_penerbit'	=> $faker->numberBetween(1,90),
        		'id_tahun'		=> $faker->numberBetween(1,50),
                'id_klasifikasi'=> $faker->numberBetween(5,13),
        		// 'deskripsi'		=> $faker->text,
        		'jumlah'		=> $faker->numberBetween(20,30),
        		'stok'			=> $faker->numberBetween(10,15),
        		'created_at'	=> date('Y-m-d H:i:s'),
        		'updated_at'	=> date('Y-m-d H:i:s'),
        		]);
        }
    }
}
