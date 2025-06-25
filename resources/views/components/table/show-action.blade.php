@props([
  "href" => null,
])

@if ($href)
  <a wire:navigate href="{{ $href }}" {{ $attributes }}>
    <x-icons.eye class="h-6 w-6 text-blue-400" />
  </a>
@else
  <button {{ $attributes->merge(["class" => "cursor-pointer"]) }}>
    <x-icons.eye class="h-6 w-6 text-blue-400" />
  </button>
@endif
