@props(['id', 'value', 'label'])

<div class="inline-flex items-center">
    <label class="relative flex items-center p-3 rounded-full cursor-pointer" htmlFor="{{ $id }}">
        <input type="radio" id="{{ $id }}" value="{{ $value }}" wire:model="form.motivos"
            class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-gray-200 text-gray-900 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:before:bg-gray-900 hover:before:opacity-10">
        <span
            class="absolute text-gray-900 transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 16 16" fill="currentColor">
                <circle data-name="ellipse" cx="8" cy="8" r="8"></circle>
            </svg>
        </span>
       
    </label>
    <label class="mt-px font-light text-gray-700 cursor-pointer " htmlFor="{{ $id }}">{{ $label }}</label>
</div>
