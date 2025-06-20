@props([
  "label" => null,
])

<th
  {{
    $attributes->merge([
      "scope" => "col",
      "class" => "whitespace-nowrap",
    ])
  }}
>
  {{ $label ? __($label) : $slot }}
</th>
