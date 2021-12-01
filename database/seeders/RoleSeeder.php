<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ajifatur\FaturCMS\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            ['key' => 'it', 'name' => 'IT', 'is_admin' => 1],
            ['key' => 'manager', 'name' => 'Manager', 'is_admin' => 1],
            ['key' => 'mentor', 'name' => 'Mentor', 'is_admin' => 1],
            ['key' => 'finance', 'name' => 'Finance', 'is_admin' => 1],
            ['key' => 'cs', 'name' => 'Customer Service', 'is_admin' => 1],
            ['key' => 'trainer', 'name' => 'Trainer', 'is_admin' => 0],
            ['key' => 'student', 'name' => 'Student', 'is_admin' => 0],
        ];

        foreach($array as $key=>$data){
            Role::firstOrCreate(['key_role' => $data['key']], ['nama_role' => $data['name'], 'is_admin' => $data['is_admin'], 'role_at' => date('Y-m-d H:i:s')]);
        }
    }
}
