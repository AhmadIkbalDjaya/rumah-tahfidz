@props([
  "label" => "Tambah",
])

<button
  {{
    $attributes->merge([
      "class" => "btn btn-sm btn-success text-white",
    ])
  }}
>
  <x-icons.plus class="h-4 w-4" />
  <span class="hidden md:block">{{ $label }}</span>
</button>
