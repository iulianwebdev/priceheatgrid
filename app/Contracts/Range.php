<?php

namespace App\Contracts;

abstract class Range
{
    /**
     * lower range.
     *
     * @var int
     */
    protected $min;

    /**
     * upper range.
     *
     * @var int
     */
    protected $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function getMax(): int
    {
        return $this->max;
    }
}
