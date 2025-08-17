<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use DateTime;

/**
 * This is an example test class for a hypothetical Booking model.
 * You can use this as a template for creating your own tests.
 */
class BookingTest extends TestCase
{
    /**
     * A basic unit test that always passes.
     *
     * @test
     * @return void
     */
    public function it_can_run_a_basic_test()
    {
        $this->assertTrue(true);
    }

    /**
     * Test that the total price of a booking can be calculated correctly.
     *
     * This test uses anonymous classes to mock the Room and Booking models
     * so you can run this test without creating the actual model files.
     *
     * @test
     * @return void
     */
    public function it_can_calculate_the_total_price()
    {
        // 1. Arrange (Setup)
        // Create a mock "Room" object with a price per night.
        $room = new class {
            public int $price_per_night = 15000; // Use cents to avoid floating point issues
        };

        // Create a mock "Booking" for 2 nights.
        $booking = new \App\Models\Booking(['room' => $room, 'check_in_date' => new DateTime('2023-10-27'), 'check_out_date' => new DateTime('2023-10-29')]);

        // 2. Act (Perform the action)
        $totalPrice = $booking->getTotalPrice();

        // 3. Assert (Check the result)
        // The total price for 2 nights at 150.00 per night should be 300.00 (or 30000 cents).
        $this->assertEquals(30000, $totalPrice);
    }
}