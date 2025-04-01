<x-layout>
    <div class="item-card">
        <div class="item-header">
            <h1 class="item-title">Edit item</h1>
        </div>
        
        <form action="{{ route('shoppingListItem.update', $shoppingListItem) }}" method="POST" class="item-content">
            @csrf
            @method('PUT')
            
            <div class="item-field-group">
                <label for="name" class="item-label">item Name</label>
                <input type="text" name="name" id="name" class="item-input" 
                    value="{{ old('name', $shoppingListItem->name ?? '') }}" required>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="item-field-group">
                <div class="flex items-center">
                    <input type="hidden" name="bought" value="0">
                    <input type="checkbox" name="bought" value="1" class="item-checkbox"
                        {{ isset($shoppingListItem) && $shoppingListItem->bought ? 'checked' : '' }}>
                    <label for="bought" class="ml-2 block text-sm text-gray-700">Bought</label>
                </div>
                @error('bought')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="item-actions">
                <a href="{{ route('shoppingListItem.index') }}" class="item-button item-button-secondary">Cancel</a>
                <button type="submit" class="item-button item-button-primary">
                    Update item
                </button>
            </div>
        </form>
    </div>
</x-layout>