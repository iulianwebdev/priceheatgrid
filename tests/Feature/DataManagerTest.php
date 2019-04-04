<?php
use App\Managers\DataManager;
use App\Contracts\Processable;
use App\Managers\LevelManager;
use App\Models\Level;


class DataManagerTest extends TestCase
{
    public function testDataManagerHasProcessMethod()
    {
        $dmInfo = new ReflectionClass(DataManager::class);
        $this->assertTrue($dmInfo->implementsInterface(Processable::class));
    }
    
    public function testLevelCanBeInstantiatedCorrectly()
    {
        // Not using mocks for simple implementation

        //TODO: use a generator for fake data
        $data = [
            [1, 2, 100], // 0%
            [1, 2, 150], // 0%
            [1, 2, 200], // 0%
            [1, 2, 220], // 5-10%
            [1, 2, 350], // 10-25%
        ];
        // $average = (100 + 150 + 200 + 250 + 350) / 5; // = 210

        $levelManager = new LevelManager();
        $levelManager->addLevel(new Level(0, 5));
        $levelManager->addLevel(new Level(5, 10));
        $levelManager->addLevel(new Level(10, 25));

        $dataManager = new DataManager($levelManager);
        $result = $dataManager->process($data);



        $this->assertEquals([
            ['x' => 1, 'y' => 2, 'value'=> 100, 'level' => 0],
            ['x' => 1, 'y' => 2, 'value'=> 150, 'level' => 0],
            ['x' => 1, 'y' => 2, 'value'=> 200, 'level' => 0],
            ['x' => 1, 'y' => 2, 'value'=> 220, 'level' => 1],
            ['x' => 1, 'y' => 2, 'value'=> 350, 'level' => 2],
        ], $result);
    }
}
