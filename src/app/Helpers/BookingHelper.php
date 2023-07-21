<?php

namespace App\Helpers;

use DateTime;

class BookingHelper
{
    public static function bookHotel(int $hotelId, string $arrivalDate, int $nights, array &$capacity): bool
    {
        $dateStart = new DateTime($arrivalDate);
        $dateEnd   = new DateTime($arrivalDate);
        $dateEnd->modify('+'.$nights.' days');

        $bookedNights = 0;
        $capacityIds  = [];

        while ($bookedNights < $nights) {
            foreach ($capacity as $key => &$item) {
                $date = new DateTime($item['date']);
                if ($item['hotel_id'] === $hotelId && $date >= $dateStart && $date <= $dateEnd) {
                    if ($item['capacity'] <= 0) {
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

            $bookedNights++;
        }

        return false;
    }
}
