<?php

namespace Ajifatur\FaturCMS\DummySeeder;

use Illuminate\Database\Seeder;
use Ajifatur\FaturCMS\Models\Setting;

class DummySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            // General
            ['key' => 'site.name', 'value' => 'FaturCMS'],
            ['key' => 'site.tagline', 'value' => 'Solusi Aplikasi CMS dengan Fitur Referral'],

            // Color
            ['key' => 'site.color.primary_dark', 'value' => '#dcb722'], // Gold
            ['key' => 'site.color.primary_light', 'value' => '#faf5df'],
            ['key' => 'site.color.secondary_dark', 'value' => '#2181db'], // Azure
            ['key' => 'site.color.secondary_light', 'value' => '#dfedfa'],

            // Price
            ['key' => 'site.komisi_student', 'value' => 25000],
            ['key' => 'site.komisi_trainer', 'value' => 50000],
            ['key' => 'site.biaya_aktivasi', 'value' => 99000],
            ['key' => 'site.harga_dicoret', 'value' => 999000],
            ['key' => 'site.min_withdrawal', 'value' => 50000],

            // View
            ['key' => 'site.view.login', 'value' => 'login'],
            ['key' => 'site.view.register', 'value' => 'register'],
            ['key' => 'site.view.forgot_password', 'value' => 'forgot-password'],
            ['key' => 'site.view.email_verification', 'value' => 'email-verification'],
            ['key' => 'site.view.check_certificate', 'value' => 'check-certificate'],
            ['key' => 'site.view.sertifikat_trainer', 'value' => 'sertifikat-trainer'],
            ['key' => 'site.view.sertifikat_peserta', 'value' => 'sertifikat-peserta'],
        ];

        foreach($array as $key=>$data){
            $setting = Setting::where('setting_key','=',$data['key'])->first();
            if($setting){
                $setting->setting_value = $data['value'];
                $setting->save();
            }
        }
    }
}
