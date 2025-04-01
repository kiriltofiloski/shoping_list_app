<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ShoppingListItem;
use Illuminate\Support\Facades\Storage;

class ExportShoppingList extends Command
{
    protected $signature = 'shopping-list:export 
                            {--path= : Custom export path}';
    
    protected $description = 'Export shopping list items to JSON';

    public function handle()
    {
        $items = ShoppingListItem::all();
        $json = $items->toJson(JSON_PRETTY_PRINT);
        
        $filename = 'shopping_list_'.now()->format('Y-m-d').'.json';
        
        if ($this->option('path')) {
            // For custom paths, use direct file operations
            $path = $this->option('path');
            file_put_contents($path, $json);
        } else {
            // Use Laravel's storage system
            Storage::disk('local')->put('exports/'.$filename, $json);
            $path = storage_path('app/exports/'.$filename);
        }
        
        $this->info("Shopping list exported to: {$path}");
        return 0;
    }
}