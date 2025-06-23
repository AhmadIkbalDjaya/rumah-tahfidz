@props([
  "modal_id",
])

<li>
  <button
    onclick="{{ $modal_id }}.showModal()"
    class="flex items-center text-sm font-medium text-red-400"
  >
    <x-icons.trash class="h-4 w-4 font-bold" />
    Hapus terpilih
  </button>
</li>
