<?php

namespace BusinessTime\Tests\Unit\BusinessTime;

use BusinessTime\BusinessTime;
use LengthException;
use PHPUnit\Framework\TestCase;
use Throwable;

class IterationLimitTest extends TestCase
{
    public function testThrowsOnIterationLimit()
    {
        // Given we have a business time;
        $businessTime = new BusinessTime();

        // And we set the iteration limit to be very low;
        $businessTime->setIterationLimit(3);

        // When we try to add several business hours;
        $error = null;

        try {
            $businessTime->addBusinessHours(36);
        } catch (Throwable $e) {
            $error = $e;
        }

        // Then an error should be thrown due to the iteration limit.
        self::assertInstanceOf(LengthException::class, $error);
        self::assertEquals($error->getMessage(), 'Iteration limit of 3 reached.');
    }
}
