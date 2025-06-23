<?php

use App\Models\Hifz;
use App\Models\Student;
use Livewire\Volt\Component;
use App\Livewire\Forms\{StudentForm, HifzForm};
use Livewire\Attributes\{Layout, Title};
use App\Traits\Livewire\{WithToast, Table\TableSearchPagination};

new class extends Component {
  use TableSearchPagination, WithToast;
  #[Layout("components.layouts.base")]
  #[Title("Detail Santri")]
  public Student $student;
  public StudentForm $form;
  public HifzForm $hifzForm;

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
      ->where("student_id", $this->student->id)
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

  public function delete(Student $student)
  {
    $this->form->setStudent($student);
    $this->form->destroy();
    $this->redirect(route("students.index"), navigate: true);
    $this->toast("Santri berhasil dihapus", "success");
  }

  public function deleteHifz(Hifz $hifz)
  {
    $this->hifzForm->setHifz($hifz);
    $this->hifzForm->destroy();
    $this->toast("Hafalan berhasil dihapus", "success");
  }
}; ?>

<div>
  <div class="my-1.5 flex items-center justify-between">
    <h1 class="text-lg font-medium">Detail Santri</h1>
    <x-breadcrumbs class="hidden md:block">
      <x-breadcrumbs.item label="Dashboard" :href="route('home')" />
      <x-breadcrumbs.item label="Santri" :href="route('students.index')" />
      <x-breadcrumbs.item label="Detail Santri" />
    </x-breadcrumbs>
  </div>
  <div class="mb-3 md:text-end">
    <a
      wire:navigate.hover
      href="{{ route("students.edit", ["student" => $student->id, "student_id" => $student->id]) }}"
    >
      <button class="btn btn-warning btn-sm text-white">
        <x-icons.edit class="h-4 w-4" />
        <span class="">Edit</span>
      </button>
    </a>
    <button
      onclick="confirmDelete.showModal()"
      class="btn btn-error btn-sm text-white"
    >
      <x-icons.trash class="h-4 w-4" />
      <span class="">Hapus</span>
    </button>
  </div>
  <div class="grid grid-cols-1 gap-x-5 gap-y-3 md:grid-cols-12">
    <div class="card bg-base-100 p-4 shadow-sm md:col-span-8">
      <h2 class="border-base-300 border-b pb-3 text-base font-medium">
        Informasi Santri
      </h2>
      <div class="mt-3 grid grid-cols-2 gap-2">
        <div class="">
          <h5 class="font-medium">Nama Santri</h5>
          <p>{{ $student->name }}</p>
        </div>
        <div class="">
          <h5 class="font-medium">Nama Wali Santri</h5>
          <p>{{ $student->guardian_name }}</p>
        </div>
        <div class="">
          <h5 class="font-medium">Kelas</h5>
          <p>{{ $student->claass?->name }}</p>
        </div>
        <div class="">
          <h5 class="font-medium">Jumlah Zidayah</h5>
          <p>{{ $student->hifzs->count() }}</p>
        </div>
      </div>
    </div>
    <div class="card bg-base-100 p-4 shadow-sm md:col-span-4">
      <div class="mt-3">
        <h5 class="font-medium">Dibuat pada</h5>
        <p>{{ $student->created_at->diffForHumans() }}</p>
      </div>
      <div class="mt-3">
        <h5 class="font-medium">Diperbarui pada</h5>
        <p>{{ $student->updated_at->diffForHumans() }}</p>
      </div>
    </div>
  </div>

  <div x-data="delete_data" class="card bg-base-100 my-5 p-4 shadow">
    <h2 class="text-base font-medium">Hafalan Santri</h2>
    <div class="flex justify-between gap-x-5 py-4">
      <x-table.search placeholder="Cari Hafalan" />
      <a
        wire:navigate.hover
        href="{{ route("hifz.create", ["student_id" => $student->id]) }}"
      >
        <x-table.create-button label="Tambah Hafalan" />
      </a>
    </div>

    <x-table>
      <thead>
        <tr>
          <x-table.th class="px-3 text-center">No</x-table.th>
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
              class="px-3 text-center"
            />
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
                :href="route('hifz.edit', ['hifz' => $hifz->id, 'student_id' => $student->id])"
              />
              <x-table.delete-action
                onclick="confirmDeleteHifz.showModal()"
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

    <x-modal.delete
      id="confirmDeleteHifz"
      wire:confirm="deleteHifz(deleteData.id)"
      wire:target="deleteHifz"
      x-on:close="resetDelete"
    />

    <x-modal.delete
      id="confirmDelete"
      wire:confirm="delete({{ $student->id }})"
      wire:target="delete"
    />
  </div>
</div>
