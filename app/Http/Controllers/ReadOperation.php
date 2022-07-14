<?php

namespace App\Http\Controllers;

use App\Models\DataWithBlob;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\Request;

class ReadOperation extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = [];
        for($i=0; $i<40; $i++) {
            $randomIndex = random_int(0, DatabaseSeeder::COUNT - 1);
            $randomId = hash('md5', "$randomIndex");
            $data[] = DataWithBlob::firstWhere('random_id', $randomId)->text_data;
        }
        return join("\n", $data);
    }
}
