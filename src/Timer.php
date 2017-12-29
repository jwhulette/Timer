<?php

namespace SimpleTimer;

/**
 *  Simple timer class
 *  This class requires PHP 5.
 */
class Timer
{
    /**
     * The time the timer was started.
     *
     * @var float
     */
    private $start_time;

    /**
     * The time the timer was paused.
     *
     * @var float
     */
    private $pause_time = 0.0;

    /**
     * Save the current time.
     *
     * @var float
     */
    private $split = 0.0;

    /**
     * The number of decimals to use.
     *
     * @var int
     */
    private $decimals = 8;

    /**
     * Start the timer.
     *
     * @param bool Start the timer on initialization
     */
    public function __construct($start_time = true)
    {
        if ($start_time) {
            $this->start();
        }
    }

    /**
     * Start the timer.
     */
    public function start()
    {
        $this->start = $this->getTime();
    }

    /**
     * End the timer.
     *
     * @return string a formatted string of the elapsed time
     */
    public function end()
    {
        $time = $this->get();

        return $this->formatReturnTime($time);
    }

    /**
     * Pause the timer.
     */
    public function pause()
    {
        $this->pause_time = $this->getTime();
    }

    /**
     * Resume the timer.
     */
    public function resume()
    {
        $this->start += ($this->getTime() - $this->pause_time);
        $this->pause_time = 0.0;
    }

    /**
     * Get the current run time.
     *
     * @return string The time elapsed so far
     */
    public function split()
    {
        if (0 == $this->split) {
            $this->split = $this->start;
        }
        $time = $this->get($this->split);
        $this->split = $this->getTime();

        return $this->formatReturnTime($time);
    }

    /**
     * Get the current run time.
     *
     * @return string The total elapsed time
     */
    public function elapsed()
    {
        $time = round(($this->getTime() - $this->start), $this->decimals);

        return $this->formatReturnTime($time);
    }

    /**
     * Get the number of miliseconds elapsed.
     *
     * @return int
     */
    public function getMilliSeconds()
    {
        return round(($this->getTime() - $this->start) * 1000, $this->decimals);
    }

    /**
     * Get the number of seconds elapsed.
     *
     * @return int
     */
    public function getSeconds()
    {
        return floor($this->getTime() - $this->start);
    }

    /**
     * Get the number of minutes elapsed.
     *
     * @return int
     */
    public function getMinutes()
    {
        $secs = floor($this->getTime() - $this->start);

        return floor($secs / 60);
    }

    /**
     * Get the current timer value.
     *
     * @method get
     *
     * @param float $split The elapsed time
     *
     * @return float The time formatted in seconds with microseonds
     */
    private function get($split = null)
    {
        if (null == $split) {
            $end = $this->start;
        } else {
            $end = $split;
        }

        return round(($this->getTime() - $end), $this->decimals);
    }

    /**
     * Format the time if greater than 60 seconds.
     *
     * @method formatReturnTime
     *
     * @param float $time A time span
     *
     * @return string The hh:mm:ss.mm
     */
    private function formatReturnTime($time)
    {
        $secs = floor($time);
        $milliseconds = (int) (($time - $secs) * 1000);
        $hours = floor($secs / 3600);
        $minutes = floor(($secs / 60) % 60) < 10 ? '0'.floor(($secs / 60) % 60) : floor(($secs / 60) % 60);
        $seconds = floor($secs % 60) < 10 ? '0'.floor($secs % 60) : floor($secs % 60);

        if ($hours > 0) {
            return sprintf('%s:%s:%s.%s', $hours, $minutes, $seconds, $milliseconds);
        }
        if ($minutes > 0) {
            return sprintf('%s:%s.%s', $minutes, $seconds, $milliseconds);
        }

        return sprintf('%s.%s seconds', $seconds, $milliseconds);
    }

    /**
     * Format the time in seconds.
     *
     * @method getTime
     *
     * @return float
     */
    private function getTime()
    {
        return microtime(true);
    }
}
