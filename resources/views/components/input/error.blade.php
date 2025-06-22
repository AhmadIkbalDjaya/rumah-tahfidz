@props([
  "name",
])

@error($name)
  <span {{ $attributes->merge(["class" => "label text-red-500"]) }}>
    {{ $message }}
  </span>
@enderror
