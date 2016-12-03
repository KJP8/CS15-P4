<?php

use Illuminate\Database\Seeder;
use App\Food;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foods')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'food_name' => 'Banana',
        ]);
        
        DB::table('foods')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'food_name' => 'Apple',
        ]);
        
        DB::table('foods')->insert([
        'created_at' => Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
        'food_name' => 'Orange',
        ]);
        
        $existingFoods = Food::all()->keyBy('food_name')->toArray();
        foreach($foods as $food) {
            # If the food does not already exist, add them
            if(!array_key_exists(food[0],$existingFoods)) {
                $food = User::create([
                    'created_at' => $food[0],
                    'updated_at' => $food[1],
                    'food_name' => $food[2],
                ]);
            }
        }
    }
}
