<?php
namespace App\Managers;

use App\Contracts\Processable;


class DataManager implements Processable
{
    /**
     * array of raw input data
     *
     * @var array[]
     */
    protected $inputData = [];

    /**
     * array of new formatdata
     *
     * @var array[]
     */
    protected $newData = [];

    /**
     * Average value for data set
     *
     * @var float
     */
    protected $average;

    /**
     * levels to process by
     *
     * @var LevelManager
     */
    protected $levelManager;

    public function __construct(LevelManager $levelManager)
    {
        $this->levelManager = $levelManager;
    }

    public function process(array $inputData) : array
    {
        
        if (empty($this->levelManager->getLevels()) || empty($inputData)) {
            return [];
        }

        return $this->resetData()
                    ->withNewDataSet($inputData)
                    ->calculateAverage()
                    ->populateNewDataWithTheRightLevels();
    }

    /**
     * Set the inputData to be processed
     *
     * @param array $inputData
     * @return DataManager
     */
    private function withNewDataSet(array $inputData)
    {
        $this->inputData = $inputData;
        return $this;
    }

    /**
     * Calculate average value
     *
     * @return void
     */
    private function calculateAverage()
    {
        $totalPrice = array_reduce($this->inputData, function ($sum, $value) {
            return $sum += $value[2];
        }, 0);
        
        $this->average = round($totalPrice / count($this->inputData));

        return $this;
    }

    private function populateNewDataWithTheRightLevels()
    {   
        foreach ($this->inputData as $row) {
            $value = $this->extractValue($row);
            $this->newData[] = [
                'x' => $this->extractX($row),
                'y' => $this->extractY($row),
                'value' => $value,
                'level' => $this->calculateLevel($value),
            ];
        }
        return $this->newData;
    }

    private function calculatelevel(int $value)
    {
        $percentage = round((($value - $this->average)  * 100) / $this->average);

        return $this->levelManager->getLevelIndex((int) $percentage);
    }

    private function extractValue(array $row)
    {
        return $row[2];
    }
    
    private function extractX(array $row)
    {
        return $row[0];
    }

    private function extractY(array $row)
    {
        return $row[1];
    }

    private function resetData()
    {
        $this->data = [];
        return $this;
    }




}
