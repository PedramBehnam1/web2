<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HotelControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/hotel/search?query=qqqqqqqq');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('td:nth-child(2)', 'qqqqqqqqqqqq');
       
    }
}
