<!-- dropdown-linknab.blade.php -->
@props(['href', 'text', 'icon'])

@php
    $id = $attributes->get('id') ?? uniqid('dropdown_');
@endphp

<li class="list-none ">
    <button type="button"
    class="group flex items-center px-5 w-full py-0.5 text-sm font-medium active:bg-gray-50 text-gray-700 hover:bg-[#00316334] hover:text-[#003163]"
        aria-controls="{{ $id }}"
        data-collapse-toggle="{{ $id }}">
    {!! $icon !!}
    <span class="pl-2 grow py-2 font-bold capitalize">{{ $text }}</span>
    <svg class="w-6 h-6 ml-auto hi-outline hi-home inline-block text-[#0b4558] " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
    </svg>
    </button>
    <ul id="{{ $id }}" class="hidden py-2 pl-4 space-y-2 list-none"> <!-- Agrega la clase 'list-none' aquí -->
        {{ $slot }}
    </ul>
</li>
