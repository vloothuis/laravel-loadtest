<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataWithBlobSeeder extends Seeder
{
    const COUNT = 1_000_000;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DataWithBlob::class, self::COUNT)->create();
    }
}
