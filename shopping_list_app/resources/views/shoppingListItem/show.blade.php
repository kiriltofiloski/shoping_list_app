<x-layout>
    <div class="item-card">
        <div class="item-header">
            <div class="flex justify-between items-center">
                <h1 class="item-title">item Details</h1>
                <span class="item-status {{ $shoppingListItem->bought ? 'item-status-bought' : 'item-status-pending' }}">
                    {{ $shoppingListItem->bought ? 'Bought' : 'Pending' }}
                </span>
            </div>
        </div>
        
        <div class="item-content">
            <div class="item-field-group">
                <h2 class="item-label">item Name</h2>
                <p class="text-lg text-gray-800">{{ $shoppingListItem->name }}</p>
            </div>
            
            <div class="item-field-group">
                <h2 class="item-label">Status</h2>
                <div class="flex items-center">
                    <div class="h-4 w-4 rounded-full {{ $shoppingListItem->bought ? 'bg-green-500' : 'bg-gray-300' }} mr-2"></div>
                    <span>{{ $shoppingListItem->bought ? 'This item has been purchased' : 'This item is pending purchase' }}</span>
                </div>
            </div>
            
            <div class="item-field-group">
                <h2 class="item-label">Created At</h2>
                <p class="text-gray-800">{{ !empty($shoppingListItem->created_at) ? $shoppingListItem->created_at->format('M j, Y g:i A') : '' }}</p>
            </div>
            
            <div class="item-field-group">
                <h2 class="item-label">Last Updated</h2>
                <p class="text-gray-800">{{ !empty($shoppingListItem->created_at) ? $shoppingListItem->updated_at->format('M j, Y g:i A') : ''  }}</p>
            </div>
            
            <div class="item-actions">
                <a href="{{ route('shoppingListItem.index') }}" class="item-button item-button-secondary">Back to List</a>
                <a href="{{ route('shoppingListItem.edit', $shoppingListItem) }}" class="item-button item-button-primary">Edit item</a>
            </div>
        </div>
    </div>
</x-layout>