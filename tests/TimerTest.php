<?php

use SimpleTimer\Timer;
use PHPUnit\Framework\TestCase;

/**
 *  @author jwhulette@gmail.com
 */
class TimerTest extends TestCase
{
    public function test_check_can_create_timer()
    {
        $t = new Timer();
        $this->assertTrue(is_object($t));
    }

    public function test_time_in_seconds()
    {
        $t = new Timer();
        sleep(2);
        $time = $t->end();
        $this->assertTrue($time, 2);
    }
}
