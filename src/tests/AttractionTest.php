<?php

namespace App\Tests;

use App\Entity\Attraction;
use PHPUnit\Framework\TestCase;

class AttractionTest extends TestCase
{
    public function testSomething(): void
    {
        $attraction = new Attraction("peed","ssss","ddddddd",10);
        $this->assertEquals("peed",$attraction->getName());
    }
}
