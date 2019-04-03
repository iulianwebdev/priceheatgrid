<?php
namespace App\Managers;

use App\Contracts\Range;
use App\Contracts\HasLabel;

class LevelManager
{
    protected $levels;
    
    public function addLevel(Range $level)
    {
        $this->levels[] = $level;
        return $this;
    }

    public function getLabels()
    {
        return array_reduce($this->levels, function ($carry, $level) {
            $carry[] = $level->label();
            return $carry;
        }, []);
    }
}
