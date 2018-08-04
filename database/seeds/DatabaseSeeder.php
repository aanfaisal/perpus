<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('tahun_terbit_seeder');
        $this->call('penerbit_seeder');
        $this->call('penulis_seeder');
        $this->call('buku_seeder');
        $this->call('anggota_seeder');
    }
}
