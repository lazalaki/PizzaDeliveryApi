<?php

namespace App\Services;

use App\Food;

class FoodService {

    public function getFood()
    {
        $foods = Food::latest()->get();

        return response()->json(['foods' => $foods]);
    }
}