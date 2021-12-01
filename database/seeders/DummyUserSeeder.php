<?php

namespace Ajifatur\FaturCMS\DummySeeder;

use Illuminate\Database\Seeder;
use App\Models\User;
use Ajifatur\FaturCMS\Models\Setting;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check user with IT access
        $count_it = User::where('role','=',role('it'))->count();

        // Create user account if $count_it less than 1
        if($count_it < 1){
            $user = new User;
            $user->nama_user = 'Admin';
            $user->email = 'admin@admin.com';
            $user->username = 'admin@admin.com';
            $user->password = bcrypt('password');
            $user->tanggal_lahir = date('Y-m-d');
            $user->jenis_kelamin = 'L';
            $user->nomor_hp = '081234567890';
            $user->reference = '';
            $user->foto = '';
            $user->role = role('it');
            $user->is_admin = 1;
            $user->status = 1;
            $user->email_verified = 1;
            $user->saldo = 0;
            $user->last_visit = null;
            $user->register_at = date('Y-m-d H:i:s');
            $user->save();
        }

        // Check user with Trainer access
        $count_trainer = User::where('role','=',role('trainer'))->count();

        // Create user account if $count_trainer less than 1
        if($count_trainer < 1){
            $user = new User;
            $user->nama_user = 'Member';
            $user->email = 'member@member.com';
            $user->username = 'member@member.com';
            $user->password = bcrypt('password');
            $user->tanggal_lahir = date('Y-m-d');
            $user->jenis_kelamin = 'L';
            $user->nomor_hp = '081234567890';
            $user->reference = '';
            $user->foto = '';
            $user->role = role('trainer');
            $user->is_admin = 0;
            $user->status = 1;
            $user->email_verified = 1;
            $user->saldo = 0;
            $user->last_visit = null;
            $user->register_at = date('Y-m-d H:i:s');
            $user->save();

            // Get data after save
            $latest_user = User::where('username','=','member@member.com')->first();
            if($latest_user){
                // Save to default referral
                Setting::updateOrCreate(['setting_key' => 'site.referral'], ['setting_name' => 'Default Kode Referral', 'setting_value' => $latest_user->id_user, 'setting_category' => kategori_setting('referral'), 'setting_rules' => '', 'setting_order' => 0]);
            }
        }
    }
}
