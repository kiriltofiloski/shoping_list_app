<x-layout title="Shopping List">
    <div class="admin-header">
        <h1 class="admin-title">Shopping List</h1>
        <a href="{{ route('shoppingListItem.create') }}" class="admin-create-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            New Item
        </a>
        <a href="{{ route('shoppingListItem.showImport') }}" class="admin-create-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Import
        </a>
        <a href="{{ route('shoppingListItem.export') }}" class="admin-create-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Export
        </a>
    </div>

    <div class="admin-table-container">
        <table class="admin-table">
            <thead class="admin-table-header">
                <tr>
                    <th class="admin-table-th px-6 py-4">Item Name</th>
                    <th class="admin-table-th px-6 py-4">Status</th>
                    <th class="admin-table-th px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="admin-table-body">
                @foreach($shoppingListItems as $item)
                <tr class="admin-table-row">
                    <td class="admin-table-td px-6 py-5 font-medium">
                        <a href="{{ route('shoppingListItem.show', $item->id) }}" class="item-name-link">
                            {{ $item->name }}
                        </a>
                    </td>
                    <td class="admin-table-td px-6 py-5">
                        <span class="status-badge {{ $item->bought ? 'status-bought' : 'status-pending' }}">
                            {{ $item->bought ? 'Bought' : 'Pending' }}
                        </span>
                    </td>
                    <td class="admin-table-td px-6 py-5">
                        <div class="flex space-x-4">
                            <a href="{{ route('shoppingListItem.edit', $item->id) }}" class="action-button edit-button">
                                Edit
                            </a>
                            <form action="{{ route('shoppingListItem.destroy', $item->id) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-button delete-button" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-container mt-8">
        {{ $shoppingListItems->links() }}
    </div>
</x-layout>