@props(['name'])

@error($name)
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror