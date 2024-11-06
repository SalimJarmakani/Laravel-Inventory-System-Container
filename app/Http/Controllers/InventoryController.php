<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{

    public function create()
    {

        return view("create");
    }

    public function index()
    {
        $inventories = Inventory::all();

        // Return the view and pass the inventory data
        return view('index', compact('inventories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // Create the new inventory item and save it to the database
        Inventory::create([
            'product_name' => $validated['product_name'],
            'category' => $validated['category'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
        ]);

        // Redirect with success message
        return redirect()->route('inventory.index')->with('success', 'Inventory item added successfully!');
    }

    public function edit($id)
    {
        // Find the inventory item by its ID
        $inventory = Inventory::findOrFail($id);

        // Return the view with the inventory item to edit
        return view('edit', compact('inventory'));
    }

    public function update(Request $request, $id)
    {

        // Validate the incoming request data
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // Find the inventory item by its ID
        $inventory = Inventory::findOrFail($id);

        // Update the inventory item
        $inventory->update($validated);

        // Redirect back to the inventory index with a success message
        return redirect()->route('inventory.index')->with('success', 'Inventory item updated successfully!');
    }

    public function destroy($id)
    {
        // Find the inventory item by its ID
        $inventory = Inventory::findOrFail($id);

        // Delete the inventory item
        $inventory->delete();

        // Redirect back to the inventory index with a success message
        return redirect()->route('inventory.index')->with('success', 'Inventory item deleted successfully!');
    }
}
