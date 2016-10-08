<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ItemCategorySeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(GroceryListSeeder::class);
    }
}
