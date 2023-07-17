<?php

namespace App\Helpers;

class BookingHelper
{
    public static function bookHotel(int $hotelId, string $arrivalDate, string $format, int $nights, array $capacity): bool
    {
        $dateStart    = strtotime($arrivalDate);
        $dateEnd      = strtotime('+'.$nights.' day', $dateStart);

        $bockedNights = 0;
        $capacityIds  = [];

        while ($bockedNights < $nights) {
            foreach ($capacity as $key => &$item) {
                $date = strtotime($item['date']);
                if ($item['hotel_id'] === $hotelId && $date >= $dateStart && $date <= $dateEnd) {
                    if ($item['capacity'] === 0) {
                        return false;
                    }

                    $capacityIds[] = $key;
                    if (count($capacityIds) === $nights) {
                        foreach ($capacityIds as $capacityId) {
                            $capacity[$capacityId]['capacity']--;
                        }

                        return true;
                    }
                }
            }

            $bockedNights++;
        }

        return false;
    }
}
