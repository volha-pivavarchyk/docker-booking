<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BookingRepository implements BookingRepositoryInterface
{
    public function getAllBookings(): \Illuminate\Support\Collection
    {
        return Booking::all();
    }

    public function getCountBookingForHotel(int $hotelId = 0): Collection
    {
        return Booking::select('hotel_id as hotelId', DB::raw('COUNT(*) as bookingCount'))
            ->groupBy('hotel_id')
            ->get();
    }
}
