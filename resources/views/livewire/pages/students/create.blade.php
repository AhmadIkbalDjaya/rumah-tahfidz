<?php

use App\Models\Claass;
use Livewire\Volt\Component;
use App\Livewire\Forms\StudentForm;
use App\Traits\Livewire\{WithToast};
use Livewire\Attributes\{Layout, Title};

new class extends Component {
  use WithToast;
  #[Layout("components.layouts.base")]
  #[Title("Tambah Santri")]
  public StudentForm $form;

  public function with(): array
  {
    $claases = Claass::select(["id", "name"])
      ->orderBy("name", "asc")
      ->get();

    return [
      "claases" => $claases,
    ];
  }

  public function store()
  {
    $this->form->store();
    $this->redirect(route("students.index"));
    $this->toast("Data Santri Berhasil Ditambahkan", "success");
  }
}; ?>

<div>
  <form wire:submit="store">
    <div class="my-1.5 flex items-center justify-between">
      <h3 class="text-lg font-medium text-gray-800">Tambah Santri</h3>
      <x-breadcrumbs class="hidden md:block">
        <x-breadcrumbs.item label="Dashboard" :href="route('home')" />
        <x-breadcrumbs.item label="Santri" :href="route('students.index')" />
        <x-breadcrumbs.item label="Tambah Santri" />
      </x-breadcrumbs>
    </div>
    <div class="bg-base-100 my-3 rounded p-4 shadow">
      <h3 class="text-base font-medium text-gray-800">Data Santri</h3>
      <div class="grid gap-x-5 md:grid-cols-3">
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Nama Santri</legend>
          <input
            wire:model.live="form.name"
            type="text"
            class="input"
            placeholder="Masukkan Nama Santri"
          />
          @error("form.name")
            <x-input.error-message field="form.name" />
          @enderror
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Kelas</legend>
          <select wire:model.live="form.claass_id" class="select">
            <option value="" disabled selected>Pilih Kelas</option>
            @foreach ($claases as $claass)
              <option value="{{ $claass->id }}">{{ $claass->name }}</option>
            @endforeach
          </select>
          @error("form.claass_id")
            <x-input.error-message field="form.claass_id" />
          @enderror
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Nama Wali</legend>
          <input
            wire:model.live="form.guardian_name"
            type="text"
            class="input"
            placeholder="Masukkan Nama Wali"
          />
          @error("form.guardian_name")
            <x-input.error-message field="form.guardian_name" />
          @enderror
        </fieldset>
      </div>
    </div>
    <div class="flex justify-end gap-x-3">
      <a href="{{ route("students.index") }}">
        <button
          type="button"
          class="btn btn-sm btn-ghost flex items-center gap-x-2"
        >
          <x-icons.x class="h-4 w-4" />
          Batal
        </button>
      </a>
      <button
        wire:target="store"
        wire:loading.attr="disabled"
        type="submit"
        class="btn btn-sm btn-success text-white"
      >
        <span
          wire:loading
          wire:target="store"
          class="loading loading-spinner loading-xs text-white"
        ></span>
        Simpan
      </button>
    </div>
  </form>
</div>
