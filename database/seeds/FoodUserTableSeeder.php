<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Food;

class FoodsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # First, create an array of all the users we want to associate foods with
        # The *key* will be the user, and the *value* will be an array of foods.
        $users =[
            'Jill' => ['Apple','Orange'],
            'Jamal' => ['Apple','Orange', 'Banana'],
        ];
        # Now loop through the above array, creating a new pivot for each user to food
        foreach($users as $name => $foods) {
            # First get the user
            $user = User::where('name','like',$name)->first();
            # Now loop through each food for this user, adding the pivot
            foreach($foods as $foodName) {
                $food = Food::where('food_name','LIKE',$foodName)->first();
                # Connect this tag to this book
                $user->foods()->save($food);
            }
        }
    }
}
