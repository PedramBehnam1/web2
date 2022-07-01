<?php

namespace App\Tests;

use App\Services\SearchHotel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SearchHotelTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        /** @var SearchHotel $searchHotel */
        $searchHotel = $container->get(SearchHotel::class);
        $result = $searchHotel->search('q');
        $this->assertNotEmpty($result);
        $this->assertEquals(1,count($result));
       
    }
}
