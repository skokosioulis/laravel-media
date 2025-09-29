<?php

namespace Skokosioulis\LaravelMedia\Livewire;

use Livewire\Component;

class SortableTest extends Component
{
    public $items = [
        ['id' => 1, 'name' => 'Item 1'],
        ['id' => 2, 'name' => 'Item 2'],
        ['id' => 3, 'name' => 'Item 3'],
        ['id' => 4, 'name' => 'Item 4'],
        ['id' => 5, 'name' => 'Item 5'],
    ];

    public function updateTaskOrder($orderedIds)
    {
        // Reorder items based on the new order
        $orderedItems = [];
        foreach ($orderedIds as $id) {
            $item = collect($this->items)->firstWhere('id', $id);
            if ($item) {
                $orderedItems[] = $item;
            }
        }

        $this->items = $orderedItems;

        // Dispatch event for debugging
        $this->dispatch('test-reordered', ['orderedIds' => $orderedIds]);

        // Show success message
        session()->flash('message', 'Items reordered successfully!');
    }

    public function render()
    {
        return view('laravel-media::livewire.sortable-test');
    }
}
