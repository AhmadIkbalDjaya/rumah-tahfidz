<?php

use App\Models\Student;
use Livewire\Volt\{Component};
use App\Livewire\Forms\StudentForm;
use Livewire\Attributes\{Layout, Title};
use App\Traits\Livewire\{WithToast, Table\TableSearchPagination};

new class extends Component {
  use TableSearchPagination, WithToast;
  #[Layout("components.layouts.base")]
  #[Title("Daftar Santri")]
  public StudentForm $form;

  public function with(): array
  {
    $students = Student::select(["id", "name", "claass_id", "guardian_name"])
      ->with(["claass:id,name"])
      ->when($this->search, function ($query) {
        $query
          ->where("name", "LIKE", "%$this->search%")
          ->orWhere("guardian_name", "LIKE", "%$this->search%")
          ->orWhereHas("claass", function ($query) {
            $query->where("name", "LIKE", "%$this->search%");
          });
      })
      ->latest()
      ->paginate($this->perpage);
    return [
      "students" => $students,
    ];
  }

  public function delete(Student $student)
  {
    $this->form->setStudent($student);
    $this->form->destroy();
    $this->toast("Santri berhasil dihapus", "success");
  }
}; ?>

<div
  x-data="{
    deleteData: null,
    setDelete(data) {
      this.deleteData = data
    },
    resetDelete() {
      this.deleteData = null
    },
  }"
>
  <div class="my-1.5 flex items-center justify-between">
    <h3 class="text-lg font-medium">Santri</h3>
    <x-breadcrumbs class="hidden md:block">
      <x-breadcrumbs.item label="Dashboard" :href="route('home')" />
      <x-breadcrumbs.item label="Santri" />
    </x-breadcrumbs>
  </div>
  <div class="bg-base-100 my-3 rounded shadow">
    <div class="flex justify-between gap-x-5 p-4">
      <x-table.search placeholder="Cari Santri" />
      <a wire:navigate.hover href="{{ route("students.create") }}">
        <x-table.create-button label="Tambah Santri" />
      </a>
    </div>
    <x-table>
      <thead>
        <tr>
          <x-table.th class="px-2 text-center">No</x-table.th>
          <x-table.th label="Nama" />
          <x-table.th label="Kelas" class="text-center" />
          <x-table.th label="Nama Wali" />
          <x-table.th label="Aksi" />
        </tr>
      </thead>
      <tbody>
        @foreach ($students as $student)
          <tr wire:key="{{ $student->id }}">
            <x-table.th
              :label="$students->firstItem() + $loop->index"
              class="px-2 text-center"
            />
            <x-table.td :label="$student->name" />
            <x-table.td :label="$student->claass->name" class="text-center" />
            <x-table.td :label="$student->guardian_name" />
            <x-table.td class="flex items-center gap-x-2">
              <x-table.show-action
                :href="route('students.show', ['student' => $student->id])"
              />
              <x-table.edit-action
                :href="route('students.edit', ['student' => $student->id])"
              />
              <x-table.delete-action
                onclick="confirmDelete.showModal()"
                x-on:click="setDelete({{ $student }})"
              />
            </x-table.td>
          </tr>
        @endforeach
      </tbody>
    </x-table>

    <div class="flex justify-between gap-y-2 p-4">
      <x-table.perpage />
      <x-table.pagination :paginator="$students" />
    </div>
  </div>

  <dialog id="confirmDelete" class="modal">
    <div class="modal-box">
      <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold">Konfirmasi Hapus!</h3>
        <form method="dialog">
          <button
            x-on:click="resetDelete"
            class="btn btn-sm btn-circle btn-ghost"
          >
            <x-icons.x class="h-5 w-5 font-medium" />
          </button>
        </form>
      </div>
      <p class="py-4">
        Apakah Anda yakin ingin menghapus data ini?
        <br />
        Data yang telah dihapus tidak dapat dikembalikan.
      </p>
      <div class="modal-action">
        <form method="dialog">
          <button x-on:click="resetDelete" class="btn btn-sm btn-ghost">
            Batal
          </button>
          <button
            wire:click="delete(deleteData.id)"
            wire:target="delete"
            wire:loading.attr="disabled"
            class="btn btn-sm btn-error text-white"
          >
            <span
              wire:loading
              wire:target="delete"
              class="loading loading-spinner loading-xs text-white"
            ></span>
            Ya, Hapus
          </button>
        </form>
      </div>
    </div>
  </dialog>
</div>
