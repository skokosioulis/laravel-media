<div class="sortable-test-component">
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <p class="text-sm text-gray-600">
            <strong>Instructions:</strong> Try dragging the items by their handles (⋮⋮) to reorder them.
        </p>
    </div>

    <ul wire:sortable="updateTaskOrder" class="space-y-2">
        @foreach($items as $item)
            <li wire:sortable.item="{{ $item['id'] }}" wire:key="test-item-{{ $item['id'] }}"
                class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-center space-x-3">

                <!-- Drag Handle -->
                <div wire:sortable.handle class="cursor-move text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 2zM7 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 8zM7 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 7 14zM13 2a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 2zM13 8a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 8zM13 14a2 2 0 1 1 .001 4.001A2 2 0 0 1 13 14z"></path>
                    </svg>
                </div>

                <!-- Item Content -->
                <div class="flex-1">
                    <span class="font-medium text-gray-900">{{ $item['name'] }}</span>
                    <span class="text-sm text-gray-500 ml-2">(ID: {{ $item['id'] }})</span>
                </div>

                <!-- Status Indicator -->
                <div class="text-sm text-gray-500">
                    Sortable Item
                </div>
            </li>
        @endforeach
    </ul>

    <div class="mt-4 text-xs text-gray-500">
        <p><strong>Debug Info:</strong></p>
        <p>Current order: {{ collect($items)->pluck('id')->implode(', ') }}</p>
        <p>Total items: {{ count($items) }}</p>
    </div>

    <!-- Include the JavaScript -->
    @once
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
        @endpush
    @endonce
</div>
