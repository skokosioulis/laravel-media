<div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
    @if($media['type'] === 'image')
        <img src="{{ $media['url'] }}" 
             alt="{{ $media['alt_text'] ?? $media['name'] }}" 
             class="w-full h-full object-cover">
    @else
        <div class="w-full h-full flex items-center justify-center">
            <div class="text-center">
                @switch($media['type'])
                    @case('document')
                        <svg class="w-8 h-8 text-red-500 mx-auto mb-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                        @break
                    @case('video')
                        <svg class="w-8 h-8 text-purple-500 mx-auto mb-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v8a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm3 2v4l4-2-4-2z" clip-rule="evenodd" />
                        </svg>
                        @break
                    @case('audio')
                        <svg class="w-8 h-8 text-green-500 mx-auto mb-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM15.657 6.343a1 1 0 011.414 0A9.972 9.972 0 0119 12a9.972 9.972 0 01-1.929 5.657 1 1 0 11-1.414-1.414A7.971 7.971 0 0017 12a7.971 7.971 0 00-1.343-4.243 1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        @break
                    @default
                        <svg class="w-8 h-8 text-gray-500 mx-auto mb-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                        </svg>
                @endswitch
                <p class="text-xs text-gray-600 truncate px-1">{{ $media['name'] }}</p>
            </div>
        </div>
    @endif
</div>

<!-- Remove Button -->
<button 
    wire:click="removeFile({{ $media['id'] }})"
    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-600"
    onclick="return confirm('Are you sure you want to delete this file?')"
>
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
</button>

<!-- File Info Tooltip -->
<div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white text-xs p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
    <p class="truncate">{{ $media['name'] }}</p>
    <p>{{ $media['human_readable_size'] }}</p>
</div>
