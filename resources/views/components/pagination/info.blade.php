@props([
  "paginator" => [],
])

<span
  class="me-5 mb-4 hidden w-full text-sm font-normal text-gray-500 md:mb-0 md:inline md:w-auto dark:text-gray-400"
>
  Menampilkan
  <span class="font-semibold text-gray-900 dark:text-white">
    {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}
  </span>
  dari
  <span class="font-semibold text-gray-900 dark:text-white">
    {{ $paginator->total() }}
  </span>
</span>
