<h1>Edit Inventory Item</h1>

<form action="{{ route('inventory.update', $inventory->id) }}" method="POST">
    @csrf

    <div>
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="{{ old('product_name', $inventory->product_name) }}" required>
    </div>

    <div>
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="{{ old('category', $inventory->category) }}" required>
    </div>

    <div>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $inventory->quantity) }}" required min="0">
    </div>

    <div>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="{{ old('price', $inventory->price) }}" required min="0" step="0.01">
    </div>

    <div>
        <button type="submit">Update Item</button>
        <a href="{{ route('inventory.index') }}">Cancel</a>
    </div>
</form>