<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ajifatur\FaturCMS\Models\KategoriSetting;

class KategoriSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['kategori' => 'Umum', 'slug' => 'general', 'prefix' => 'site.'],
            ['kategori' => 'Warna', 'slug' => 'color', 'prefix' => 'site.color.'],
            ['kategori' => 'Harga', 'slug' => 'price', 'prefix' => 'site.'],
            ['kategori' => 'Sertifikat', 'slug' => 'certificate', 'prefix' => 'site.sertifikat.'],
            ['kategori' => 'Penerima Notifikasi', 'slug' => 'receivers', 'prefix' => 'site.'],
            ['kategori' => 'View', 'slug' => 'view', 'prefix' => 'site.view.'],
            ['kategori' => 'Logo', 'slug' => 'logo', 'prefix' => 'site.'],
            ['kategori' => 'Icon', 'slug' => 'icon', 'prefix' => 'site.'],
            ['kategori' => 'Referral', 'slug' => 'referral', 'prefix' => 'site.'],
            ['kategori' => 'Server', 'slug' => 'server', 'prefix' => 'site.server.'],
        ];

        foreach($array as $key=>$data){
            KategoriSetting::updateOrCreate(['kategori' => $data['kategori'], 'slug' => $data['slug']], ['prefix' => $data['prefix']]);
        }
    }
}
