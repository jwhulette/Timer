<?php

/**
 * Simple timer class
 * This class requires PHP 5
 */
class Timer
{
    /**
     * The time the timer was started
     *
     * @var float
     */
    private $start;

    /**
     * The time the timer was paused
     *
     * @var float
     */
    private $pause_time;

    /**
     * Save the current time
     *
     * @var float
     */
    private $split = 0;

    /**
     * The number of decimals to use
     *
     * @var int
     */
    private $decimals = 8;

    /**
     * start the timer
     *
     * @method __construct
     *
     * @param  integer     $start A start id for multiple timers
     */
    public function __construct($start = null)
    {
        if (is_null($start)) {
            $this->start();
        }
    }

    /**
     * Start the timer
     *
     * @method start
     *
     * @return none
     */
    public function start()
    {
        $this->start = $this->getTime();
        $this->pause_time = 0;
    }

    /**
     * End the timer
     *
     * @method end
     *
     * @return mixed the time elapsed
     */
    public function end()
    {
        $time = $this->get();
        return $this->formatReturnTime($time);
    }

    /**
     * Pause the timer
     *
     * @method pause
     *
     * @return none
     */
    public function pause()
    {
        $this->pause_time = $this->getTime();
    }

    /**
     * Unpause the timer
     *
     * @method resume
     *
     * @return none
     */
    public function resume()
    {
        $this->start += ($this->getTime() - $this->pause_time);
        $this->pause_time = 0;
    }

    /**
     * Get the current run time
     *
     * @method split
     *
     * @return float            The time elapsed so far
     */
    public function split()
    {
        if ($this->split == 0) {
            $this->split = $this->start;
        }
        $time = $this->get($this->split);
        $this->split = $this->getTime();

        if ($time > 60) {
            return $this->formatReturnTime($time);
        }
        return $time;
    }

    /**
     * Get the current run time
     *
     * @method elapsed
     *
     * @return float            The total elapsed time
     */
    public function elapsed()
    {
        $time = round(($this->getTime() - $this->start), $this->decimals);
        return $this->formatReturnTime($time);
    }

    /**
     * Get the current timer value
     *
     * @method get
     *
     * @param  float        $split  The elapsed time
     *
     * @return float                The time formatted in seconds with microseonds
     */
    private function get($split = null)
    {
        if ($split == null) {
            $end = $this->start;
        } else {
            $end = $split;
        }
        return round(($this->getTime() - $end), $this->decimals);
    }

    /**
     * Format the time if greater than 60 seconds
     *
     * @method formatReturnTime
     *
     * @return string           The hh:mm:ss.mm
     */
    private function formatReturnTime($time)
    {
        $secs = floor($time);
        $milli = (int) (($time - $secs) * 1000);

        $hours = floor($secs / 3600);
        $minutes = floor(($secs / 60) % 60);
        $seconds = floor($secs % 60);
        if ($hours > 0) {
            return sprintf('%s:%s:%s.%s', $hours, $minutes, $seconds, $milli);
        }
        if ($minutes > 0) {
            return sprintf('%s:%s.%s', $minutes, $seconds, $milli);
        }
        return sprintf('%s.%s seconds', $seconds, $milli);
    }

    /**
     * Format the time in seconds
     *
     * @method getTime
     *
     * @return float   The formated time
     */
    private function getTime()
    {
        return microtime(true);
    }
}
