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
    $students = Student::select(["id", "name", "guardian_name", "class_name"])
      ->when($this->search, function ($query) {
        $query
          ->where("name", "LIKE", "%$this->search%")
          ->orWhere("guardian_name", "LIKE", "%$this->search%")
          ->orWhere("class_name", "LIKE", "%$this->search%");
      })
      ->latest()
      ->paginate($this->perpage);
    return [
      "students" => $students,
    ];
  }

  public function delete(Student $student): void
  {
    $this->form->setStudent($student);
    $this->form->destroy();
    $this->toast("Santri berhasil dihapus", "success");
  }

  public function bulkDelete(array $ids): void
  {
    $this->form->bulkDestroy($ids);
    $this->toast(
      count($ids) . " Data santri terpilih berhasil dihapus",
      "success",
    );
  }

  public function getAllId(): array
  {
    return Student::pluck("id")->toArray();
  }
}; ?>

<div x-data="delete_data">
  <div x-data="table_selected({{ $students->total() }}, 'getAllId')">
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
            santri terpilih?
            <br />
            Data yang telah dihapus tidak dapat dikembalikan.
          </x-modal.delete>
          <a wire:navigate href="{{ route("students.create") }}">
            <x-table.create-button label="Tambah Santri" />
          </a>
        </div>
      </div>
      <x-table.selection-bar
        selectedLength="selected.length"
        totalData="{{ $students->total() }}"
        selectAll="selectAll"
        unselectAll="unselectAll"
      />
      <x-table>
        <thead>
          <tr>
            <x-table.th.checkbox
              id="selectAllData"
              x-bind:checked="(selected.length == total_data) && (total_data != 0)"
              x-on:click="toggleSelectAll"
            />
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
              <x-table.th.checkbox
                id="data-checkbox-{{ $student->id }}"
                :value="$student->id"
                x-model="selected"
              />
              <x-table.th
                :label="$students->firstItem() + $loop->index"
                class="px-2 text-center"
              />
              <x-table.td :label="$student->name" />
              <x-table.td
                :label="$student->class_name ?? '--'"
                class="text-center"
              />
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

    <x-modal.delete
      id="confirmDelete"
      wire:target="delete"
      x-on:close="resetDelete"
      x-on:confirm="$wire.delete(deleteData.id); resetDelete(); total_data -= 1;"
    />
  </div>
</div>
