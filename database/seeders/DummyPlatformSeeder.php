<?php

namespace Ajifatur\FaturCMS\DummySeeder;

use Illuminate\Database\Seeder;
use Ajifatur\FaturCMS\Models\Platform;

class DummyPlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['nama' => 'Bank Negara Indonesia (BNI)', 'tipe' => 1, 'kode' => '009'],
            ['nama' => 'Bank Rakyat Indonesia (BRI)', 'tipe' => 1, 'kode' => '002'],
            ['nama' => 'Bank Tabungan Negara (BTN)', 'tipe' => 1, 'kode' => '200'],
            ['nama' => 'Bank Mandiri', 'tipe' => 1, 'kode' => '008'],
            ['nama' => 'Bank Syariah Indonesia (BSI)', 'tipe' => 1, 'kode' => '451'],
            ['nama' => 'Go-Pay', 'tipe' => 2, 'kode' => ''],
            ['nama' => 'Shopee-Pay', 'tipe' => 2, 'kode' => ''],
            ['nama' => 'OVO', 'tipe' => 2, 'kode' => ''],
            ['nama' => 'LinkAja', 'tipe' => 2, 'kode' => ''],
            ['nama' => 'DANA', 'tipe' => 2, 'kode' => ''],
            ['nama' => 'EduPay', 'tipe' => 2, 'kode' => ''],
        ];

        foreach($array as $key=>$data){
            Platform::updateOrCreate(['nama_platform' => $data['nama']], ['tipe_platform' => $data['tipe'], 'kode_platform' => $data['kode']]);
        }
    }
}
