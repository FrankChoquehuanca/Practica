<a href="{{ $href }}"
class="group flex items-center space-x-2 px-5 py-0.5 text-sm font-medium active:bg-gray-50 text-gray-700 hover:bg-[#00316334] hover:text-[#003163]">
    <span class="flex flex-none items-center opacity-75">
        <div stroke-width="1.5" stroke="currentColor"
        class="hi-outline hi-home inline-block h-6 w-6 text-[#0b4558]">
            {!! $icon !!}
        </div>
    </span>
    <span class="grow py-2 font-bold capitalize">{{ $text }}</span>
</a>
