<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface BookingRepositoryInterface
{
    public function getAllBookings(): \Illuminate\Support\Collection;

    public function getCountBookingForHotel(): Collection;

}
