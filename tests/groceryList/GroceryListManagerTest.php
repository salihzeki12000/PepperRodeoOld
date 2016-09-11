<?php

use App\GroceryLists\GroceryListManager;
use App\GroceryList;
use App\Recipe;
use App\Item;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroceryListManagerTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @group grocery-list-manager-test
     * @return void
     */
    public function testExample()
    {
        $grocerylist = factory(GroceryList::class)->create();
        $recipe = $this->createRecipe();

        $itemCount = $recipe->items->count();

        $groceryListManager = $this->getGroceryListManager($grocerylist);

        $groceryListManager->addRecipe($recipe->getKey());

        $this->assertTrue($grocerylist->recipes->contains($recipe));
        $this->assertEquals($recipe->items->first()->name, $grocerylist->items->first()->name);
//        $this->assertEquals($recipe->items->last()->name, $grocerylist->items->last()->name);
        $this->assertEquals($itemCount, $recipe->items->count());

    }

    private function getGroceryListManager($grocerylist)
    {
        return new GroceryListManager($grocerylist);
    }

    private function createRecipe()
    {
        $recipe = factory(Recipe::class)->create();
        $item = factory(Item::class, 15)->create();

        $recipe->items()->saveMany($item);

        return $recipe;
    }
}