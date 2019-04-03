<?php

use App\Managers\LevelManager;
use App\Models\Level;

class LevelsManagerTest extends TestCase
{
    protected $levels;

    protected function setUp(): void
    {
        $this->levels = new LevelManager;
    }

    public function testClassHasLabelMethod()
    {
        $this->assertTrue(method_exists($this->levels, 'getLabels'));
    }

    public function testLevelsReturnsAllLabels()
    {
        $this->levels
            ->addLevel(new Level(0, 5))
            ->addLevel(new Level(5, 15));

        $expectedLabels = ['0% - 5%', '5% - 15%'];

        $this->assertEquals($expectedLabels, $this->levels->getLabels());
    }
}
