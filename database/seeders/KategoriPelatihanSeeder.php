<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ajifatur\FaturCMS\Models\KategoriPelatihan;

class KategoriPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['kategori' => 'Webinar', 'slug' => 'webinar'],
            ['kategori' => 'Seminar', 'slug' => 'sebinar'],
            ['kategori' => 'Pelatihan', 'slug' => 'pelatihan'],
            ['kategori' => 'Workshop', 'slug' => 'workshop'],
            ['kategori' => 'Magang', 'slug' => 'magang'],
            ['kategori' => 'Prakerin', 'slug' => 'prakerin'],
            ['kategori' => 'Short Course', 'slug' => 'short-course'],
        ];

        foreach($array as $key=>$data){
            KategoriPelatihan::updateOrCreate(['kategori' => $data['kategori']], ['slug' => $data['slug']]);
        }
    }
}
