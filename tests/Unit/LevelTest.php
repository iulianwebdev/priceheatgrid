<?php

use App\Models\Level;
use App\Contracts\Range;
use App\Contracts\HasLabel;

class LevelTest extends TestCase
{
    public function testLevelInheritanceAndInterfaceImplementation()
    {
        $level = new ReflectionClass(Level::class);
        $this->assertTrue($level->isSubclassOf(Range::class));
        $this->assertTrue($level->implementsInterface(HasLabel::class));
    }

    public function testLevelCanBeInstantiatedCorrectly()
    {
        $level = new Level(0, 5);

        $this->assertEquals(0, $level->getMin());
        $this->assertEquals(5, $level->getMax());
    }
}
