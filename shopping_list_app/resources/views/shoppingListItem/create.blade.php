<x-layout>
    <div class="item-card">
        <div class="item-header">
            <h1 class="item-title">Add New item</h1>
        </div>
        
        <form action="{{ route('shoppingListItem.store') }}" method="POST" class="item-content">
            @csrf
            @method('POST')
            
            <div class="item-field-group">
                <label for="name" class="item-label">item Name</label>
                <input type="text" name="name" id="name" class="item-input" 
                    value="" required>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="item-field-group">
                <div class="flex items-center">
                    <input type="hidden" name="bought" value="0">
                    <input type="checkbox" name="bought" value="1" class="item-checkbox">
                    <label for="bought" class="ml-2 block text-sm text-gray-700">Bought</label>
                </div>
                @error('bought')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="item-actions">
                <a href="{{ route('shoppingListItem.index') }}" class="item-button item-button-secondary">Cancel</a>
                <button type="submit" class="item-button item-button-primary">
                    Save item
                </button>
            </div>
        </form>
    </div>
</x-layout>