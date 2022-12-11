@props(['name'])

<label class="block mb-2 uppercase font-bold text-cs text-gray-700" for="{{ $name }}">
    {{ ucwords($name) }}
</label>