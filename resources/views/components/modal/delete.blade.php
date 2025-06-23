@props([
  "id" => null,
  "title" => "Konfirmasi Hapus!",
  "description" => null,
])

<dialog id="{{ $id }}" class="modal">
  <div class="modal-box">
    <div class="flex items-center justify-between">
      <h3 class="text-lg font-bold">{{ $title }}</h3>
      <form method="dialog">
        <button
          x-on:click="{{ $attributes->get("x-on:close") }}"
          @if($attributes->get("wire:close"))wire:click="{{ $attributes->get("wire:close") }}"@endif
          class="btn btn-sm btn-circle btn-ghost"
        >
          <x-icons.x class="h-5 w-5 font-medium" />
        </button>
      </form>
    </div>
    <p class="py-4">
      @if (! $description)
        {!! $slot != "" ? $slot : "Apakah Anda yakin ingin menghapus data ini? <br> Data yang telah dihapus tidak dapat dikembalikan." !!}
      @else
        {{ $description }}
      @endif
    </p>
    <div class="modal-action">
      <form method="dialog">
        <button
          x-on:click="{{ $attributes->get("x-on:close") }}"
          @if($attributes->get("wire:close"))wire:click="{{ $attributes->get("wire:close") }}"@endif
          class="btn btn-sm btn-ghost"
        >
          Batal
        </button>
        <button
          @if($attributes->get("wire:confirm"))wire:click="{{ $attributes->get("wire:confirm") }}"@endif
          wire:target="{{ $attributes->get("wire:target") }}"
          wire:loading.attr="disabled"
          class="btn btn-sm btn-error text-white"
        >
          <span
            wire:loading
            wire:target="{{ $attributes->get("wire:target") }}"
            class="loading loading-spinner loading-xs text-white"
          ></span>
          Ya, Hapus
        </button>
      </form>
    </div>
  </div>
</dialog>
