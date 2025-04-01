<x-layout>
    <div class="item-card">
        <div class="item-header">
            <h1 class="item-title">Import items from JSON file</h1>
        </div>
        
        <form action="{{ route('shoppingListItem.import') }}" method="POST" class="item-content" enctype="multipart/form-data">
            @csrf
            @method('POST')
            
            <div class="item-field-group">
                <label for="file" class="item-label">Choose file</label>
                <input type="file" name="file" id="file" class="item-input" accept=".json" required>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="item-actions">
                <a href="{{ route('shoppingListItem.index') }}" class="item-button item-button-secondary">Cancel</a>
                <button type="submit" class="item-button item-button-primary">
                    Import
                </button>
            </div>
        </form>
    </div>
</x-layout>