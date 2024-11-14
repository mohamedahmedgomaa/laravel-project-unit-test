<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CalcTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_calculate_a_numbers(): void
    {
        $calc = calc(10, 10);
        $this->assertEquals(20, $calc, 'error not calculate');
    }
}
