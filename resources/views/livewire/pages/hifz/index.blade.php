<?php

use App\Models\Hifz;
use Livewire\Volt\{Component};
use App\Livewire\Forms\HifzForm;
use Livewire\Attributes\{Layout, Title};
use App\Traits\Livewire\{WithToast, Table\TableSearchPagination};

new class extends Component {
  use TableSearchPagination, WithToast;
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
    $this->toast("Hafalan berhasil dihapus", "success");
  }

  public function bulkDelete(array $ids): void
  {
    $this->form->bulkDestroy($ids);
    $this->toast(count($ids) . " Data terpilih berhasil dihapus", "success");
  }

  public function getAllId(): array
  {
    return Hifz::pluck("id")->toArray();
  }
}; ?>

<div x-data="delete_data">
  <div x-data="table_selected({{ $hifzs->total() }}, 'getAllId')">
    <div class="my-1.5 flex items-center justify-between">
      <h3 class="text-lg font-medium">Daftar Hafalan Santri</h3>
      <x-breadcrumbs class="hidden md:block">
        <x-breadcrumbs.item label="Dashboard" :href="route('home')" />
        <x-breadcrumbs.item label="Daftar Hafalan" />
      </x-breadcrumbs>
    </div>
    <div class="bg-base-100 my-3 rounded shadow">
      <div class="flex justify-between gap-x-5 p-4">
        <x-table.search placeholder="Cari Hafalan" />
        <div class="flex w-fit gap-x-1.5">
          <x-table.bulk.dropdown x-show="selected.length > 0">
            <x-table.bulk.delete-action modal_id="confirmBulkDelete" />
          </x-table.bulk.dropdown>
          <x-modal.delete
            title="Konfirmasi Hapus data terpilih?"
            id="confirmBulkDelete"
            wire:target="bulkDelete"
            x-on:confirm="$wire.bulkDelete(selected); total_data -= selected.length; unselectAll();"
          >
            Apakah Anda yakin ingin menghapus
            <span
              x-text="selected.length"
              class="font-bold text-red-400"
            ></span>
            hafalan terpilih?
            <br />
            Data yang telah dihapus tidak dapat dikembalikan.
          </x-modal.delete>
          <a wire:navigate href="{{ route("hifz.create") }}">
            <x-table.create-button label="Tambah Hafalan" />
          </a>
        </div>
      </div>
      <x-table.selection-bar
        selectedLength="selected.length"
        totalData="{{ $hifzs->total() }}"
        selectAll="selectAll"
        unselectAll="unselectAll"
      />
      <x-table>
        <thead>
          <tr>
            <x-table.th.checkbox
              id="selectAllData"
              x-bind:checked="(selected.length == total_data) && (total_data!=0)"
              x-on:click="toggleSelectAll"
            />
            <x-table.th class="px-2 text-center">No</x-table.th>
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
              <x-table.th.checkbox
                id="data-checkbox-{{ $hifz->id }}"
                :value="$hifz->id"
                x-model="selected"
              />
              <x-table.th
                :label="$hifzs->firstItem() + $loop->index"
                class="px-2 text-center"
              />
              <x-table.td :label="$hifz->student->name" />
              <x-table.td>
                Surah&nbsp;{{ $hifz->surah->name }} ({{ $hifz->verse_start }}
                - {{ $hifz->verse_end }})
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
                <x-table.delete-action
                  onclick="confirmDelete.showModal()"
                  x-on:click="setDelete({{ $hifz }})"
                />
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

    <x-modal.delete
      id="confirmDelete"
      wire:target="delete"
      x-on:close="resetDelete"
      x-on:confirm="$wire.delete(deleteData.id); resetDelete(); total_data -= 1;"
    />
  </div>
</div>
