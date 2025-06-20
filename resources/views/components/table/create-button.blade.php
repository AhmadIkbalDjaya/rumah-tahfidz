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
  <svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    class="icon icon-tabler icons-tabler-outline icon-tabler-plus h-4 w-4"
  >
    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
    <path d="M12 5l0 14" />
    <path d="M5 12l14 0" />
  </svg>
  <span class="hidden md:block">{{ $label }}</span>
</button>
