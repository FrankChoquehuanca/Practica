@props(['texto', 'content'])

<p class="inline-flex flex-col xl:flex-row xl:items-center font-medium capitalize text-gray-800 italic">
    {{ $texto }}
    <span class="mt-1 xl:mt-0 font-normal not-italic">
        {{ $content }}
    </span>
</p>
