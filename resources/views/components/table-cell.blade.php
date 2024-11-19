@props(['content'])

<td class="px-6 py-4">
    @if($content)
        {{ $content }}
    @else
        <div class="flex justify-center items-center h-full">
            <span class="text-gray-400 text-center">N/A</span>
        </div>
    @endif
</td>
