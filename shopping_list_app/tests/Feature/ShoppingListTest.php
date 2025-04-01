<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\ShoppingListItem;
use App\Models\User;

class ShoppingListTest extends TestCase
{
    use RefreshDatabase;
    public function test_unathorized_access()
    {
        // Index
        $this->get(route('shoppingListItem.index'))->assertRedirect('/login');
        
        // Create
        $this->get(route('shoppingListItem.create'))->assertRedirect('/login');
        
        // Store
        $this->post(route('shoppingListItem.store'))->assertRedirect('/login');

        // Show Import
        $this->get(route('shoppingListItem.showImport'))->assertRedirect('/login');

        // Import
        $this->post(route('shoppingListItem.import'))->assertRedirect('/login');

        // Export
        $this->get(route('shoppingListItem.export'))->assertRedirect('/login');
        
        // Edit
        $shoppingListItem = ShoppingListItem::factory()->create();
        $this->get(route('shoppingListItem.edit', $shoppingListItem))->assertRedirect('/login');
        
        // Update
        $this->put(route('shoppingListItem.update', $shoppingListItem))->assertRedirect('/login');
        
        // Destroy
        $this->delete(route('shoppingListItem.destroy', $shoppingListItem))->assertRedirect('/login');
    }

    public function test_authenticated_index_access()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->get(route('shoppingListItem.index'));
        
        $response->assertStatus(200);
        $response->assertViewIs('shoppingListItem.index');
    }

    public function test_valid_item_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $this->post(route('shoppingListItem.store'), array("name" => "Chicken", "bought" => 1));
        
        $this->assertDatabaseCount('shopping_list_items', 1);
        $this->assertDatabaseHas('shopping_list_items', ['name' => 'Chicken']);
    }

    public function test_non_valid_item_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->post(route('shoppingListItem.store'), array("name" => "Chicken", "bought" => "yes"));
        
        $response->assertSessionHasErrors(['bought']);
        $this->assertDatabaseCount('shopping_list_items', 0);
    }

    public function test_valid_item_update()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $shoppingListItem = ShoppingListItem::factory()->create();
        
        $this->put(route('shoppingListItem.update', $shoppingListItem), array("name" => "Chicken", "bought" => 1));
        
        $this->assertDatabaseCount('shopping_list_items', 1);
        $this->assertDatabaseHas('shopping_list_items', ['name' => 'Chicken']);
    }

    public function test_import_shopping_list_from_json_file()
    {
        // Create test JSON file
        $testData = [
            ['name' => 'Chicken', 'bought' => false],
            ['name' => 'Donuts', 'bought' => true]
        ];
        
        $path = storage_path('app/test_import.json');
        file_put_contents($path, json_encode($testData));
        
        // Run import command
        $this->artisan('shopping-list:import', ['path' => $path])
             ->assertExitCode(0)
             ->expectsOutput('Successfully imported 2 items.');
        
        // Verify database
        $this->assertDatabaseCount('shopping_list_items', 2);
        $this->assertDatabaseHas('shopping_list_items', ['name' => 'Chicken']);
    }
}
