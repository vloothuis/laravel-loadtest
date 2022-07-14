<?php

namespace Database\Seeders;

use App\Models\DataWithBlob;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const COUNT = 1_000;
    private int $index = 0;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataWithBlob::factory()->state(
            ['random_id' => function () {
                $this->index++;
                return hash('md5', "{$this->index}");
            }]
        )->count(self::COUNT)->create();
    }
}
