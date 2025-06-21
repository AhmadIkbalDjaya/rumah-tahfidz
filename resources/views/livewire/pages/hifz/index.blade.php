<?php

use App\Models\Hifz;
use Livewire\Volt\{Component};
use App\Livewire\Forms\HifzForm;
use Livewire\Attributes\{Layout, Title};
use App\Traits\Livewire\Table\TableSearchPagination;

new class extends Component {
  use TableSearchPagination;
  #[Layout("components.layouts.base")]
  #[Title("Daftar Hafalan Santri")]
  public HifzForm $form;

  public function with(): array
  {
    $hifzs = Hifz::select([
      "id",
      "student_id",
      "surah_id",
      "verse_start",
      "verse_end",
      "review_count",
      "score",
      "recorded_at",
    ])
      ->with(["student:id,name", "surah:id,name"])
      ->when($this->search, function ($query) {
        $query
          ->whereHas("student", function ($query) {
            $query->where("name", "LIKE", "%$this->search%");
          })
          ->orWhereHas("surah", function ($query) {
            $query->where("name", "LIKE", "%$this->search%");
          });
      })
      ->orderBy("recorded_at", "DESC")
      ->paginate($this->perpage);

    return [
      "hifzs" => $hifzs,
    ];
  }

  public function delete(Hifz $hifz)
  {
    $this->form->setHifz($hifz);
    $this->form->destroy();
  }
}; ?>

<div class="">
  <div class="my-1.5 flex items-center justify-between">
    <h3 class="text-lg font-medium text-gray-800">Daftar Hafalan Santri</h3>
    <x-breadcrumbs class="hidden md:block">
      <x-breadcrumbs.item label="Dashboard" :href="route('home')" />
      <x-breadcrumbs.item label="Daftar Hafalan" />
    </x-breadcrumbs>
  </div>
  <div class="bg-base-100 my-3 rounded shadow">
    <div class="flex justify-between gap-x-5 p-4">
      <x-table.search placeholder="Cari Hafalan" />
      <a href="{{ route("hifz.create") }}">
        <x-table.create-button label="Tambah Hafalan" />
      </a>
    </div>
    <x-table>
      <thead>
        <tr>
          <x-table.th label="No" class="px-1 text-center" />
          <x-table.th label="Nama" />
          <x-table.th label="Zidayah" />
          <x-table.th label="Muroja'ah" class="text-center" />
          <x-table.th label="Nilai" class="text-center" />
          <x-table.th label="Waktu Menghafal" />
          <x-table.th label="Aksi" />
        </tr>
      </thead>
      <tbody>
        @foreach ($hifzs as $hifz)
          <tr wire:key="{{ $hifz->id }}">
            <x-table.th
              :label="$hifzs->firstItem() + $loop->index"
              class="px-1 text-center"
            />
            <x-table.td :label="$hifz->student->name" />
            <x-table.td>
              Surah&nbsp;{{ $hifz->surah->name }} {{ $hifz->verse_start }} -
              {{ $hifz->verse_end }}
            </x-table.td>
            <x-table.td :label="$hifz->review_count" class="text-center" />
            <x-table.td :label="$hifz->score" class="text-center" />
            <x-table.td>
              {{ date("d M Y - H:i", strtotime($hifz->recorded_at)) }}
            </x-table.td>

            <x-table.td class="flex items-center gap-x-2">
              <x-table.edit-action
                :href="route('hifz.edit', ['hifz' => $hifz->id])"
              />
              <x-table.delete-action wire:click="delete({{ $hifz->id }})" />
            </x-table.td>
          </tr>
        @endforeach
      </tbody>
    </x-table>

    <div class="flex justify-between gap-y-2 p-4">
      <x-table.perpage />
      <x-table.pagination :paginator="$hifzs" />
    </div>
  </div>
</div>
