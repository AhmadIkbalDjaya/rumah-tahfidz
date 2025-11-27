<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\StudentForm;
use App\Traits\Livewire\{WithToast};
use Livewire\Attributes\{Layout, Title};

new class extends Component {
  use WithToast;
  #[Layout("components.layouts.base")]
  #[Title("Tambah Santri")]
  public StudentForm $form;

  public function store()
  {
    $this->form->store();
    $this->toast("Data Santri Berhasil Ditambahkan", "success");
    $this->redirect(route("students.index"), navigate: true);
  }
}; ?>

<div>
  <form wire:submit="store">
    <div class="my-1.5 flex items-center justify-between">
      <h3 class="text-lg font-medium">Tambah Santri</h3>
      <x-breadcrumbs class="hidden md:block">
        <x-breadcrumbs.item label="Dashboard" :href="route('home')" />
        <x-breadcrumbs.item label="Santri" :href="route('students.index')" />
        <x-breadcrumbs.item label="Tambah Santri" />
      </x-breadcrumbs>
    </div>
    <div class="bg-base-100 my-3 rounded p-4 shadow">
      <h3 class="text-base font-medium">Data Santri</h3>
      <div class="grid gap-x-5 md:grid-cols-3">
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Nama Santri</legend>
          <input
            wire:model.live="form.name"
            type="text"
            class="input"
            placeholder="Masukkan Nama Santri"
          />
          <x-input.error name="form.name" />
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Kelas</legend>
          <input
            wire:model.live="form.class_name"
            type="text"
            class="input"
            placeholder="Masukkan Nama Kelas"
          />
          <x-input.error name="form.class_name" />
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Nama Wali</legend>
          <input
            wire:model.live="form.guardian_name"
            type="text"
            class="input"
            placeholder="Masukkan Nama Wali"
          />
          <x-input.error name="form.guardian_name" />
        </fieldset>
      </div>
    </div>
    <div class="flex justify-end gap-x-3">
      <a wire:navigate href="{{ route("students.index") }}">
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
