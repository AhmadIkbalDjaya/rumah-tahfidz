<?php

use App\Models\Surah;
use App\Models\Student;
use Livewire\Volt\Component;
use App\Livewire\Forms\HifzForm;
use App\Traits\Livewire\{WithToast};
use Livewire\Attributes\{Layout, Title};

new class extends Component {
  use WithToast;
  #[Layout("components.layouts.base")]
  #[Title("Tambah Hafalan")]
  public HifzForm $form;
  public $studentSearch;
  public $surahSearch;

  public function with(): array
  {
    $students = Student::select(["id", "name"])
      ->when($this->studentSearch, function ($query) {
        $query->where("name", "LIKE", "%$this->studentSearch%");
      })
      ->orderBy("name", "asc")
      ->get();
    $surahs = Surah::select(["id", "name", "number"])
      ->when($this->surahSearch, function ($query) {
        $query
          ->where("name", "LIKE", "%$this->surahSearch%")
          ->orWhere("number", "LIKE", "%$this->surahSearch%");
      })
      ->orderBy("number", "asc")
      ->get();

    return [
      "students" => $students,
      "surahs" => $surahs,
    ];
  }

  public function store()
  {
    $this->form->store();
    $this->redirect(route("hifz.index"), navigate: true);
    $this->toast("Data Hafalan Berhasil Ditambahkan", "success");
  }

  public function getSurahVarseCount($surah_id)
  {
    $surah = Surah::select("id", "varse_count")
      ->where("id", $surah_id)
      ->first();
    return $surah->varse_count;
  }
}; ?>

<div
  x-data="{
    verse_count: 0,
    getSurahVarseCount() {
      if ($wire.entangle('form.surah_id') != null) {
        let surah_id = $wire.entangle('form.surah_id')
        $wire.getSurahVarseCount(surah_id).then((verse_count) => {
          this.verse_count = verse_count
        })
      }
    },
    resetVerseCount() {
      this.verse_count = 0
      $wire.set('form.verse_start', null)
      $wire.set('form.verse_end', null)
    },
  }"
>
  <form wire:submit="store">
    <div class="my-1.5 flex items-center justify-between">
      <h3 class="text-lg font-medium">Tambah Hafalan</h3>
      <x-breadcrumbs class="hidden md:block">
        <x-breadcrumbs.item label="Dashboard" :href="route('home')" />
        <x-breadcrumbs.item
          label="Daftar Hafalan"
          :href="route('hifz.index')"
        />
        <x-breadcrumbs.item label="Tambah Hafalan" />
      </x-breadcrumbs>
    </div>

    <div class="bg-base-100 my-3 rounded p-4 shadow">
      <h3 class="text-base font-medium">Data Hafalan</h3>
      <div class="grid gap-x-10 md:grid-cols-2">
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Santri</legend>
          <div class="relative" x-data="{ isOpen: false, selected: null }">
            <input
              type="text"
              wire:model.live="studentSearch"
              class="input w-full"
              placeholder="Cari santri..."
              @focus="selected == null ? isOpen = true : isOpen = false"
              @blur="setTimeout(() => { isOpen = false }, 200)"
              x-bind:readonly="selected != null"
              x-bind:value="selected != null ? selected : ''"
            />
            <span
              class="absolute top-3 right-3 z-10 cursor-pointer"
              x-show="selected != null"
              x-cloak
              x-on:click="
                $wire.set('form.student_id', null),
                  (selected = null),
                  $wire.set('studentSearch', '')
              "
            >
              <x-icons.x class="h-4 w-4" />
            </span>
            <div
              x-show="isOpen"
              x-cloak
              class="bg-base-100 absolute z-10 mt-1 w-full rounded-md shadow-lg"
            >
              <ul class="max-h-60 overflow-auto py-1">
                @forelse ($students as $student)
                  <li>
                    <button
                      type="button"
                      x-on:click="
                        $wire.set('form.student_id', '{{ $student->id }}'),
                          (selected = @js($student->name)),
                          (isOpen = false)
                      "
                      class="w-full cursor-pointer px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-900"
                    >
                      {{ $student->name }}
                    </button>
                  </li>
                @empty
                  <li class="px-4 py-2 text-gray-500">
                    Tidak ada santri ditemukan
                  </li>
                @endforelse
              </ul>
            </div>
          </div>
          @error("form.student_id")
            <x-input.error-message field="form.student_id" />
          @enderror
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Zidayah</legend>
          <div class="relative" x-data="{ isOpen: false, selected: null }">
            <input
              type="text"
              wire:model.live="surahSearch"
              class="input w-full"
              placeholder="Cari Surah..."
              @focus="selected == null ? isOpen = true : isOpen = false"
              @blur="setTimeout(() => { isOpen = false }, 200)"
              x-bind:readonly="selected != null"
              x-bind:value="selected != null ? selected : ''"
            />
            <span
              class="absolute top-3 right-3 z-10 cursor-pointer"
              x-show="selected != null"
              x-cloak
              x-on:click="
                $wire.set('form.surah_id', null),
                  (selected = null),
                  $wire.set('surahSearch', ''),
                  resetVerseCount()
              "
            >
              <x-icons.x class="h-4 w-4" />
            </span>
            <div
              x-show="isOpen"
              x-cloak
              class="bg-base-100 absolute z-10 mt-1 w-full rounded-md shadow-lg"
            >
              <ul class="max-h-60 overflow-auto py-1">
                @forelse ($surahs as $surah)
                  <li>
                    <button
                      type="button"
                      x-on:click="
                        $wire.set('form.surah_id', '{{ $surah->id }}'),
                          (selected = @js($surah->name)),
                          (isOpen = false),
                          getSurahVarseCount()
                      "
                      class="w-full cursor-pointer px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-900"
                    >
                      {{ $surah->name }}
                    </button>
                  </li>
                @empty
                  <li class="px-4 py-2 text-gray-500">Surah tidak ditemukan</li>
                @endforelse
              </ul>
            </div>
          </div>
          @error("form.surah_id")
            <x-input.error-message field="form.surah_id" />
          @enderror
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Ayat Pertama</legend>
          <select wire:model.live="form.verse_start" class="select w-full">
            <option value="null" disabled selected>Pilih Ayat</option>
            <template x-for="i in verse_count" x-cloak>
              <option x-bind:value="i" x-text="i"></option>
            </template>
          </select>
          @error("form.verse_start")
            <x-input.error-message field="form.verse_start" />
          @enderror
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Ayat Terakhir</legend>
          <select wire:model.live="form.verse_end" class="select w-full">
            <option value="null" disabled selected>Pilih Ayat</option>
            <template x-for="i in verse_count" x-cloak>
              <option x-bind:value="i" x-text="i"></option>
            </template>
          </select>
          @error("form.verse_end")
            <x-input.error-message field="form.verse_end" />
          @enderror
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Muroja'ah</legend>
          <input
            wire:model.live="form.review_count"
            type="number"
            class="input w-full"
            placeholder=""
            min="1"
          />
          @error("form.review_count")
            <x-input.error-message field="form.review_count" />
          @enderror
        </fieldset>
        <fieldset class="fieldset">
          <legend class="fieldset-legend">Nilai</legend>
          <input
            wire:model.live="form.score"
            type="text"
            class="input w-full"
            placeholder="Masukkan Nilai"
          />
          @error("form.score")
            <x-input.error-message field="form.score" />
          @enderror
        </fieldset>
        <fieldset class="fieldset col-span-full">
          <legend class="fieldset-legend">Tanggal dan Waktu</legend>
          <input
            wire:model.live="form.recorded_at"
            type="datetime-local"
            class="input w-full"
            placeholder="Masukkan Nilai"
          />
          @error("form.recorded_at")
            <x-input.error-message field="form.recorded_at" />
          @enderror
        </fieldset>
      </div>
    </div>

    <div class="flex justify-end gap-x-3">
      <a wire:navigate.hover href="{{ route("hifz.index") }}">
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
