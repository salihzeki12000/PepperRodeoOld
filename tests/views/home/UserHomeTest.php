<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Recipe;
use App\Item;
use Carbon\Carbon;

class UserHome extends TestCase
{
    use DatabaseTransactions;
    use testHelpers;

    protected $User;

    public function setUp()
    {
        parent::setUp();

        $this->User = factory(User::class)->create();

        $this->be($this->User);
    }
    /**
     * A basic test example.
     *
     * @group UserHome
     *
     * @return void
     * @test
     */
    public function view_recipes_on_home_page()
    {
        $exampleRecipe = $this->exampleRecipeWithItems(5, ['created_at' => Carbon::now()->subDay()]);
        $exampleRecipe2 = $this->exampleRecipeWithItems(3, ['created_at' => Carbon::now()->subDays(2)]);
        $exampleRecipe3 = $this->exampleRecipeWithItems(6, ['created_at' => Carbon::now()->subDays(3)]);

        $this->User->recipes()->save($exampleRecipe);
        $this->User->recipes()->save($exampleRecipe2);
        $this->User->recipes()->save($exampleRecipe3);

        $this->visit('/')
            ->see($exampleRecipe->title)
            ->see($exampleRecipe2->title)
            ->dontSee($exampleRecipe3->title);
    }

    protected function exampleRecipeWithItems($howMany, $attributes = [])
    {
        $recipe = factory(Recipe::class)->create($attributes);
        $recipe->items()->saveMany(factory(Item::class, $howMany)->create());

        return $recipe;
    }
}