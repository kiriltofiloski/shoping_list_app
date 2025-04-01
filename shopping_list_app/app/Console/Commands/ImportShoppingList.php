<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ShoppingListItem;
use Illuminate\Support\Facades\File;

class ImportShoppingList extends Command
{
    protected $signature = 'shopping-list:import 
                            {path : Path to JSON file}';
    
    protected $description = 'Import shopping list items from JSON';

    public function handle()
    {
        $path = $this->argument('path');
        
        if (!File::exists($path)) {
            $this->error("File not found: {$path}");
            return 1;
        }
        
        $json = File::get($path);
        $data = json_decode($json, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON file');
            return 1;
        }
        
        $count = 0;
        foreach ($data as $itemData) {
            if(isset($itemData['name'])){
                $name = $itemData['name'];
                $shoppingListItem = ShoppingListItem::whereName($name)->first();
                if($shoppingListItem !== null){
                    $shoppingListItem->update($itemData);
                }
                else{
                    ShoppingListItem::create($itemData);
                }
            }
            $count++;
        }
        
        $this->info("Successfully imported {$count} items.");
        return 0;
    }
}
