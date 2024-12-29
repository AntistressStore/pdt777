<?php

namespace Database\Seeders;

use App\Services\CSV\HouseCSVParser;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = new \SplFileObject(storage_path().'/app/private/property-data.csv');

        $parser = new HouseCSVParser($file);

        $parser->seed();
    }
}
