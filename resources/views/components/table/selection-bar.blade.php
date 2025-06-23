@props([
  "selectedLength" => 0,
  "totalData" => 0,
  "selectAll" => "selectAll",
  "unselectAll" => "unselectAll",
])

<div
  x-cloak
  x-show="{{ $selectedLength }} > 0"
  class="border-base-300 flex justify-between border-b px-3 pb-1 text-xs font-medium md:text-sm dark:border-gray-700/50"
>
  <span>
    <span x-text="{{ $selectedLength }}"></span>
    data terpilih
  </span>
  <div class="flex gap-x-5">
    <span x-on:click="{{ $selectAll }}" class="cursor-pointer text-yellow-400">
      Pilih semua
      <span x-text="{{ $totalData }}"></span>
    </span>
    <span x-on:click="{{ $unselectAll }}" class="cursor-pointer text-red-400">
      Batalkan semua
    </span>
  </div>
</div>
