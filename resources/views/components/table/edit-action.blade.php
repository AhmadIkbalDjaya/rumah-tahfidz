@props([
  "href" => null,
])

@if ($href)
  <a wire:navigate href="{{ $href }}">
    <x-icons.edit class="h-6 w-6 text-yellow-400" />
  </a>
@else
  <button {{ $attributes->merge(["class" => "cursor-pointer"]) }}>
    <x-icons.edit class="h-6 w-6 text-yellow-400" />
  </button>
@endif
