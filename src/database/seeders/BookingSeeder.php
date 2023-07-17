<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileCsv = fopen(__DIR__.'/bookings.csv', 'r');

        fgetcsv($fileCsv);
        while ($csv = fgetcsv($fileCsv)) {
            Booking::create([
                'hotel_id' => $csv[1],
                'customer_id' => $csv[2],
                'sales_price' => $csv[3],
                'purchase_price' => $csv[4],
                'arrival_date' => $csv[5],
                'purchase_day' => $csv[6],
                'nights' => $csv[7],
            ]);
       }
    }
}
