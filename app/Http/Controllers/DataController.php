<?php

namespace App\Http\Controllers;

use App\Managers\LevelManager;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Managers\DataManager;

class DataController extends Controller
{
    /**
     * Levels of deviation.
     *
     * @var LevelManager
     */
    private $levels;

    public function __construct(LevelManager $levels)
    {
        $this->levels = $levels;
    }

    public function show(Request $request)
    {

        $validator = $this->validate($request, [
            'data' => 'sub_arrays_of_ints'
        ]);

        $this->levels
            ->addLevel(new Level(0, 5))
            ->addLevel(new Level(5, 25))
            ->addLevel(new Level(25, 75))
            ->addLevel(new Level(75, 95))
            ->addLevel(new Level(95, 100));
        return (new DataManager($this->levels))->process($request->data);
    }

    public function index()
    {
        // 0% - 5%
        // 5% - 25%
        // 25% - 75%
        // 75% - 95%
        // 95% - 100%
        $this->levels
            ->addLevel(new Level(0, 5))
            ->addLevel(new Level(5, 25))
            ->addLevel(new Level(25, 75))
            ->addLevel(new Level(75, 95))
            ->addLevel(new Level(95, 100));

        return $this->levels->getLabels();
    }
}
