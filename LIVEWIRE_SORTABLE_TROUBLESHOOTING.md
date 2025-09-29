# Livewire Sortable Troubleshooting Guide

## Common Issues and Solutions

### 1. 🚫 **Drag and Drop Not Working**

#### **Symptoms:**
- Items don't respond to drag attempts
- No visual feedback when hovering over drag handles
- Console shows no errors

#### **Solutions:**

**A. Ensure Scripts Load in Correct Order**
```blade
<!-- In your layout file, make sure you have: -->
@livewireStyles
<!-- Your content -->
@livewireScripts
@stack('scripts') <!-- This is crucial! -->
```

**B. Check Script Loading**
Open browser console (F12) and check:
```javascript
// Should return true if loaded correctly
typeof window.livewireSortable !== 'undefined'
```

**C. Verify Livewire Initialization**
```javascript
// Check if Livewire is ready
document.addEventListener('livewire:init', () => {
    console.log('Livewire initialized');
});
```

### 2. 🔄 **Method Not Being Called**

#### **Symptoms:**
- Drag works visually but no server-side updates
- Method `updateTaskOrder` not being triggered

#### **Solutions:**

**A. Check Method Name Match**
```blade
<!-- In Blade view -->
<ul wire:sortable="updateTaskOrder">
```

```php
// In Livewire component
public function updateTaskOrder($orderedIds)
{
    // Your logic here
}
```

**B. Add Debug Logging**
```php
public function updateTaskOrder($orderedIds)
{
    \Log::info('Sortable order updated', ['ids' => $orderedIds]);
    
    foreach ($orderedIds as $index => $mediaId) {
        Media::where('id', $mediaId)->update(['order_column' => $index + 1]);
    }
    
    $this->dispatch('media-reordered', ['orderedIds' => $orderedIds]);
}
```

### 3. 🎯 **Wire Directives Issues**

#### **Symptoms:**
- Drag handle doesn't work
- Items can't be grabbed

#### **Solutions:**

**A. Correct Directive Structure**
```blade
<ul wire:sortable="updateTaskOrder">
    @foreach($items as $item)
        <li wire:sortable.item="{{ $item['id'] }}" wire:key="item-{{ $item['id'] }}">
            <div wire:sortable.handle class="cursor-move">
                <!-- Drag handle icon -->
            </div>
            <!-- Item content -->
        </li>
    @endforeach
</ul>
```

**B. Ensure Unique Keys**
Always use `wire:key` with unique values:
```blade
wire:key="media-{{ $media['id'] }}"
```

### 4. 📱 **CSS/Styling Issues**

#### **Symptoms:**
- Drag handle not visible
- No visual feedback during drag

#### **Solutions:**

**A. Add Proper Cursor Styles**
```css
[wire\:sortable\.handle] {
    cursor: move;
    cursor: grab;
}

[wire\:sortable\.handle]:active {
    cursor: grabbing;
}
```

**B. Ensure Handle is Clickable**
```blade
<div wire:sortable.handle class="cursor-move p-2 text-gray-400 hover:text-gray-600">
    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <!-- Drag icon -->
    </svg>
</div>
```

### 5. 🔧 **Data Structure Issues**

#### **Symptoms:**
- Sorting works but data doesn't persist
- Order gets reset after page reload

#### **Solutions:**

**A. Ensure Proper Data Format**
```php
// Make sure your data has 'id' field
$existingMedia = [
    ['id' => 1, 'name' => 'file1.jpg'],
    ['id' => 2, 'name' => 'file2.jpg'],
];
```

**B. Update Database Correctly**
```php
public function updateTaskOrder($orderedIds)
{
    foreach ($orderedIds as $index => $mediaId) {
        Media::where('id', $mediaId)
            ->update(['order_column' => $index + 1]);
    }
    
    // Reload data to reflect changes
    $this->loadExistingMedia();
}
```

### 6. 🌐 **Browser Compatibility**

#### **Symptoms:**
- Works in some browsers but not others
- Mobile devices don't respond

#### **Solutions:**

**A. Check Browser Support**
Livewire Sortable requires modern browsers with:
- ES6 support
- Touch events (for mobile)

**B. Add Fallback for Older Browsers**
```blade
@if($sortablePreview)
    <div class="browser-check" style="display: none;">
        <p>Your browser may not support drag and drop. Please use a modern browser.</p>
    </div>
    <script>
        if (!('draggable' in document.createElement('div'))) {
            document.querySelector('.browser-check').style.display = 'block';
        }
    </script>
@endif
```

## 🧪 **Testing Steps**

### 1. **Basic Functionality Test**
1. Open browser console (F12)
2. Look for JavaScript errors
3. Try dragging an item
4. Check if method is called in network tab

### 2. **Debug Component**
Use the debug route: `/media/debug/sortable`

### 3. **Manual Testing**
```javascript
// In browser console, test if sortable is working:
document.querySelector('[wire\\:sortable]')
```

## 📋 **Checklist**

- [ ] Livewire Sortable script is loaded
- [ ] `@stack('scripts')` is in layout after `@livewireScripts`
- [ ] Method name matches `wire:sortable` directive
- [ ] All items have unique `wire:key` attributes
- [ ] Drag handles have `wire:sortable.handle` directive
- [ ] CSS cursor styles are applied
- [ ] Database updates are working
- [ ] No JavaScript console errors

## 🚀 **Working Example**

```blade
<div>
    <ul wire:sortable="updateTaskOrder" class="space-y-2">
        @foreach($items as $item)
            <li wire:sortable.item="{{ $item['id'] }}" 
                wire:key="item-{{ $item['id'] }}" 
                class="bg-white border rounded p-4 flex items-center">
                
                <div wire:sortable.handle 
                     class="cursor-move mr-3 text-gray-400 hover:text-gray-600">
                    ⋮⋮
                </div>
                
                <div class="flex-1">
                    {{ $item['name'] }}
                </div>
            </li>
        @endforeach
    </ul>

    @once
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
        @endpush
    @endonce
</div>
```

```php
public function updateTaskOrder($orderedIds)
{
    foreach ($orderedIds as $index => $id) {
        // Update your model
        YourModel::where('id', $id)->update(['order' => $index + 1]);
    }
    
    // Refresh data
    $this->loadData();
}
```
