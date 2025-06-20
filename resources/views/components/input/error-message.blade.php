@props([
  "field",
])

<p class="label text-red-500">
  @if ($errors->has($field))
    {{ $errors->first($field) }}
  @endif
</p>
