@props([
  "label" => null,
])

<td {{ $attributes->merge(["class" => "whitespace-nowrap"]) }}>
  {{ $label ? __($label) : $slot }}
</td>
