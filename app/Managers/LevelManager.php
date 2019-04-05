<?php
namespace App\Managers;

use App\Contracts\Range;

class LevelManager
{
    protected $levels;
    
    /**
     * add level object
     *
     * @param Range $level
     * @return void
     */
    public function addLevel(Range $level)
    {
        if (empty($this->levels)) {
            $this->levels[] = $level;
        } else {
            $this->addSorted($level);
        }
        return $this;
    }

    /**
     * get the present levels
     *
     * @return array|null
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * Get the index of the level that includes the given value
     *
     * @param integer $value
     * @return void
     */
    public function getLevelIndex(int $percentage)
    {
        $value = $percentage;
        
        if ($value <= 0) {
            return 0;
        }

        $lastIndex = 0;
        
        foreach ($this->levels as $index => $level) {
            $lastIndex = $index;

            if ($value < $level->getMax() && $value >= $level->getMin()) {
                break;
            }
        }

        return $lastIndex;
    }

    public function getLabels()
    {
        return array_reduce($this->levels, function ($carry, $level) {
            $carry[] = $level->label();
            return $carry;
        }, []);
    }

    /**
     * Adds levels in a sorted manner
     *
     * @param Range $level
     * @return void
     */
    public function addSorted(Range $level)
    {
        if (array_last($this->levels)->getMax() <= $level->getMin()) {
            $this->levels[] = $level;
        } else {
            array_unshift($this->levels, $level);
        }
    }
}
