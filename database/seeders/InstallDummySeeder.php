<?php

namespace Ajifatur\FaturCMS\DummySeeder;

use Illuminate\Database\Seeder;

class InstallDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DummyUserSeeder::class);
        $this->call(DummySettingSeeder::class);
        $this->call(DummyKategoriArtikelSeeder::class);
        $this->call(DummyKontributorSeeder::class);
        $this->call(DummyPackageSeeder::class);
        $this->call(DummyPlatformSeeder::class);
        $this->call(DummyRootFolderSeeder::class);
        $this->call(DummyRolePermissionSeeder::class);
    }
}
