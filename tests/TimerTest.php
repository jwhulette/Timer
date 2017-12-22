<?php

use Timer\Timer;
use PHPUnit\Framework\TestCase;

/**
 *  Corresponding Class to test YourClass class.
 *
 *  For each class in your library, there should be a corresponding Unit-Test for it
 *  Unit-Tests should be as much as possible independent from other test going on.
 *
 *  @author yourname
 */
class TimerTest extends TestCase
{
    public function test_check_can_create_timer()
    {
        $t = new Timer();
        $this->assertTrue(is_object($t));
    }
}
