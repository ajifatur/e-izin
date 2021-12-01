<?php

namespace Ajifatur\FaturCMS\DummySeeder;

use Illuminate\Database\Seeder;
use Ajifatur\FaturCMS\Models\Kontributor;

class DummyKontributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kontributor::firstOrCreate(['kontributor' => '-'], ['slug' => '-', 'id_kontributor' => 0]);
    }
}
