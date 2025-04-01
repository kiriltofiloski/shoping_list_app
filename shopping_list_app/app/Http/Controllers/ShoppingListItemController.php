<?php

namespace App\Http\Controllers;

use App\Models\ShoppingListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ShoppingListItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoppingListeItems = ShoppingListItem::query()
        ->orderBy('created_at', 'desc')
        ->paginate();
        return view("shoppingListItem.index", array("shoppingListItems" => $shoppingListeItems));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("shoppingListItem.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            "bought" => ['sometimes', 'boolean']
        ]);

        $shoppingListItem = ShoppingListItem::create($data);

        return to_route('shoppingListItem.show', $shoppingListItem)->with('message', 'Item was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShoppingListItem $shoppingListItem)
    {
        return view("shoppingListItem.show", array("shoppingListItem" => $shoppingListItem));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShoppingListItem $shoppingListItem)
    {
        return view("shoppingListItem.edit", array("shoppingListItem" => $shoppingListItem));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShoppingListItem $shoppingListItem)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            "bought" => ['sometimes', 'boolean']
        ]);

        $shoppingListItem->update($data);

        return to_route('shoppingListItem.show', $shoppingListItem)->with('message', 'Item was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingListItem $shoppingListItem)
    {
        $shoppingListItem->delete();

        return to_route('shoppingListItem.index')->with('message', 'Item was deleted!');
    }

    public function showImport(){
        return view('shoppingListItem.import');
    }

    public function import(Request $request){
        $request->validate(array(
            'file' => 'required|file|mimes:json|max:2048',
        ));

        $file = $request->file('file');

        $json = json_decode(file_get_contents($file->getRealPath()), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->with('error', 'Invalid JSON file!');
        }

        foreach ($json as $itemData){
            if(isset($itemData['id'])){
                $id = $itemData['id'];
                $shoppingListItem = ShoppingListItem::find($id);
                if($shoppingListItem){
                    $shoppingListItem->update($itemData);
                }
                else{
                    ShoppingListItem::create($itemData);
                }
            }
            else{
                ShoppingListItem::create($itemData);
            }
        }

        return to_route('shoppingListItem.index')->with('message', 'Items were imported!');
    }

    public function export(){
        $data = ShoppingListItem::all();

        $json = $data->toJson(JSON_PRETTY_PRINT);

        return Response::make($json, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="shopping_list_export_'.now()->format('Y-m-d').'.json"'
        ]);
    }
}
