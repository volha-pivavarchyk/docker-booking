<?php

namespace App\Services;

use App\Helpers\BookingHelper;
use App\Helpers\CalendarHelper;
use App\Repositories\BookingRepositoryInterface;
use App\Repositories\CapacityRepositoryInterface;

class StatisticService
{
    public function __construct(
        private BookingRepositoryInterface $bookingRepository,
        private CapacityRepositoryInterface $capacityRepository
    ) {
    }

    public function getHotelsWithSmallestStaysNumbers(int $limit): array
    {
        $bookings = $this->bookingRepository->getAllBookings();
        $hotels   = [];

        $bookings->each(function ($booking) use (&$hotels) {
            $countWeekends              = CalendarHelper::getCountWeekendInPeriod($booking->arrival_date, 'Y-m-d', $booking->nights);
            $hotels[$booking->hotel_id] = isset($hotels[$booking->hotel_id]) ? $hotels[$booking->hotel_id] + $countWeekends : $countWeekends;
        });

        asort($hotels);
        return array_slice($hotels, 0, $limit, true);
    }

    public function getAverageRejectionRate(): array
    {
        $bookingCount      = $this->bookingRepository->getCountBookingForHotel();
        $bookingRejections = $this->getRejectionCount();

        foreach ($bookingCount as $booking) {
            if (isset($bookingRejections['hotel'][$booking->hotelId])) {
                $hotelsRejectionRate[$booking->hotelId] = $bookingRejections['hotel'][$booking->hotelId]/$booking->bookingCount;
            }
        }

        return $hotelsRejectionRate ?? [];
    }

    public function getUnluckyCustomers(int $limit): array
    {
        $rejections = $this->getRejectionCount();
        $customerRejections = $rejections['customer'] ?? [];

        arsort($customerRejections);
        return array_slice($customerRejections, 0, $limit);
    }

    private function getRejectionCount(): array
    {
        $bookings = $this->bookingRepository->getAllBookings();
        $capacity = $this->capacityRepository->getAllCapacities()->toArray();

        $rejectionCount = [];
        foreach($bookings as $booking) {
            $isBooked = BookingHelper::bookHotel($booking->hotel_id, $booking->arrival_date, 'Y-m-d', $booking->nights, $capacity);
            if (false === $isBooked) {
                $rejectionCount['hotel'][$booking->hotel_id]       = isset($rejectionCount['hotel'][$booking->hotel_id]) ? $rejectionCount['hotel'][$booking->hotel_id]++ : 1;
                $rejectionCount['customer'][$booking->customer_id] = isset($rejectionCount['customer'][$booking->customer_id]) ? $rejectionCount['customer'][$booking->customer_id]++ : 1;
            }
        }

        return $rejectionCount;
    }
}
