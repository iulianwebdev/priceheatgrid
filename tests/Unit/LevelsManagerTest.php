<?php

use App\Managers\LevelManager;
use App\Models\Level;

class LevelsManagerTest extends TestCase
{
    /**
     * @var LevelManager
     */
    protected $levels;

    protected function setUp(): void
    {
        $this->levels = new LevelManager;
    }

    public function testClassHas_getLabel_Method()
    {
        $this->assertTrue(method_exists($this->levels, 'getLabels'));
    }

    public function testClassHas_getLevels_Method()
    {
        $this->assertTrue(method_exists($this->levels, 'getLevels'));
    }

    public function testManagerHasGetterFunctionForLevels()
    {
        $this->levels->addLevel(new Level(0, 20));
        $this->assertIsArray($this->levels->getLevels());
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
