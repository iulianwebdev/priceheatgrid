<?php

namespace App\Models;

use App\Contracts\Range;
use App\Contracts\HasLabel;

class Level extends Range implements HasLabel
{
    public function label(): string
    {
        return "{$this->min}% - {$this->max}%";
    }
}
