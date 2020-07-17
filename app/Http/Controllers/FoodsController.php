<?php

namespace App\Http\Controllers;

use App\Services\FoodService;
use Exception;
use Illuminate\Http\Request;

class FoodsController extends Controller
{

    protected $foodService;

    public function __construct(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    public function getFood()
    {
        try {
            return $this->foodService->getFood();
        } catch(Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()], 400);
        }
    }
}
