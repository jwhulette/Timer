<?php

use SimpleTimer\Timer;
use PHPUnit\Framework\TestCase;

/**
 *  @author jwhulette@gmail.com
 */
class TimerTest extends TestCase
{
    /**
     * @test
     * @covers  \Timer::__construct
     */
    public function test_check_can_create_timer()
    {
        $t = new Timer();
        $this->assertTrue(is_object($t));
    }

    /**
     * @test
     * @covers \Timer::getMilliseconds
     */
    public function test_time_in_miliseconds()
    {
        $t = new Timer();
        usleep(3);
        $time = $t->getMilliSeconds();
        $this->assertLessThan(3.0, $time);
    }

    /**
     * @test
     * @covers \Timer::getSeconds
     */
    public function test_time_in_seconds()
    {
        $t = new Timer();
        sleep(2);
        $time = $t->getSeconds();
        $this->assertEquals(2, $time);
    }

    /**
     * @test
     * @overs \Timer::getMinutes
     */
    public function test_time_in_minutes()
    {
        $t = new Timer();
        sleep(60);
        $time = $t->getMinutes();
        $this->assertEquals(1, $time);
    }
}
