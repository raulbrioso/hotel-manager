<?php

namespace Tests\Unit;

use App\Models\Hotel;
use PHPUnit\Framework\TestCase;

class HotelDeleteTest extends TestCase
{
    public function testHotelDeleteSuccessfully()
    {
        $hotel = new Hotel();
        $hotel->name = "Dummy hotel";
        $hotel->street = "C/ Invent 1";
        $hotel->postal_code = "123456";
        $hotel->city = "Andorra";
        $hotel->country_id = 1;
        $hotel->province_id = 1;

        $del = $hotel->delete();

        $this->assertNull($del);
    }
}
