<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Capacity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Vtiful\Kernel\Excel;
use Maatwebsite\Excel\Facades\Excel;

class CapacitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileCsv = fopen(__DIR__.'/capacity.csv', 'r');

        fgetcsv($fileCsv);
        while ($csv = fgetcsv($fileCsv)) {
            Capacity::create([
                'hotel_id' => $csv[0],
                'date' => $csv[1],
                'capacity' => $csv[2],
            ]);
        }
    }
}
