<?php

namespace tests\Unit\Services;

use App\Models\Booking;
use App\Models\Capacity;
use App\Repositories\BookingRepositoryInterface;
use App\Repositories\CapacityRepositoryInterface;
use App\Services\StatisticService;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;

class StatisticServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->bookingRepository  = $this->createMock(BookingRepositoryInterface::class);
        $this->capacityRepository = $this->createMock(CapacityRepositoryInterface::class);

        $this->StatisticService = new StatisticService($this->bookingRepository, $this->capacityRepository);
    }

    public function testGetHotelsWithSmallestStaysNumbers(): void
    {
        $this->bookingRepository->expects($this->once())
            ->method('getAllBookings')
            ->willReturn(new Collection($this->getBookings()));

        $result = $this->StatisticService->getHotelsWithSmallestStaysNumbers(5);

        $this->assertSame($result, [1 => 0, 2 => 2]);
    }

    public function testGetAverageRejectionRate(): void
    {

        $this->bookingRepository->expects($this->once())
            ->method('getAllBookings')
            ->willReturn(new Collection($this->getBookings()));

        $this->bookingRepository->expects($this->once())
            ->method('getCountBookingForHotel')
            ->willReturn(new Collection($this->getBookingCount()));

        $this->capacityRepository->expects($this->once())
            ->method('getAllCapacities')
            ->willReturn(new Collection($this->getCapacities()));


        $result = $this->StatisticService->getAverageRejectionRate();

        $this->assertSame($result, [1 => '100%']);
    }

    public function testGetUnluckyCustomers(): void
    {

        $this->bookingRepository->expects($this->once())
            ->method('getAllBookings')
            ->willReturn(new Collection($this->getBookings()));

        $this->capacityRepository->expects($this->once())
            ->method('getAllCapacities')
            ->willReturn(new Collection($this->getCapacities()));


        $result = $this->StatisticService->getUnluckyCustomers(5);

        $this->assertSame($result, [10 => 1]);
    }

    private function getBookings(): array
    {
        $booking1 = new Booking();
        $booking1->id = 1;
        $booking1->hotel_id = 1;
        $booking1->customer_id = 10;
        $booking1->sales_price = 100;
        $booking1->purchase_price = 100;
        $booking1->arrival_date = '2023-07-17';
        $booking1->purchase_day = '2021-04-10';
        $booking1->nights = 1;

        $booking2 = new Booking();
        $booking2->id = 2;
        $booking2->hotel_id = 2;
        $booking2->customer_id = 8;
        $booking2->sales_price = 100;
        $booking2->purchase_price = 100;
        $booking2->arrival_date = '2023-07-20';
        $booking2->purchase_day = '2021-04-11';
        $booking2->nights = 5;

        return [$booking1, $booking2];
    }

    private function getBookingCount(): array
    {
        $bookingCount1 = new Booking();
        $bookingCount1->hotelId = 1;
        $bookingCount1->bookingCount = 1;

        $bookingCount2 = new Booking();
        $bookingCount2->hotelId = 2;
        $bookingCount2->bookingCount = 1;

        return [$bookingCount1, $bookingCount2];
    }

    private function getCapacities(): array
    {
        $capacity1 = new Capacity();
        $capacity1->hotel_id = 1;
        $capacity1->date = '2023-07-17';
        $capacity1->capacity = 0;

        $capacity2 = new Capacity();
        $capacity2->hotel_id = 2;
        $capacity2->date = '2023-07-20';
        $capacity2->capacity = 1;

        $capacity3 = new Capacity();
        $capacity3->hotel_id = 2;
        $capacity3->date = '2023-07-21';
        $capacity3->capacity = 1;

        $capacity4 = new Capacity();
        $capacity4->hotel_id = 2;
        $capacity4->date = '2023-07-22';
        $capacity4->capacity = 1;

        $capacity5 = new Capacity();
        $capacity5->hotel_id = 2;
        $capacity5->date = '2023-07-23';
        $capacity5->capacity = 1;

        $capacity5 = new Capacity();
        $capacity5->hotel_id = 2;
        $capacity5->date = '2023-07-24';
        $capacity5->capacity = 1;

        return [$capacity1, $capacity2, $capacity3, $capacity4, $capacity5];
    }

}
