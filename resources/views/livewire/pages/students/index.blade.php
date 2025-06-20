<?php

use App\Models\Student;
use Livewire\Volt\{Component};
use Livewire\Attributes\{Layout, Title};
use App\Traits\Livewire\Table\TableSearchPagination;

new class extends Component {
  use TableSearchPagination;
  #[Layout("components.layouts.base")]
  #[Title("Daftar Santri")]
  public function with(): array
  {
    $students = Student::select(["id", "name", "claass_id", "guardian_name"])
      ->with(["claass:id,name"])
      ->when($this->search, function ($query) {
        $query
          ->where("name", "LIKE", "%$this->search%")
          ->orWhere("guardian_name", "LIKE", "%$this->search%");
      })
      ->latest()
      ->paginate($this->perpage);
    return [
      "students" => $students,
    ];
  }
}; ?>

<div class="">
  <div class="my-1.5 flex justify-between">
    <h3 class="text-lg font-medium text-gray-800">Santri</h3>
    <x-breadcrumbs class="hidden md:block">
      <x-breadcrumbs.item label="Dashboard" :href="route('home')" />
      <x-breadcrumbs.item label="Santri" />
    </x-breadcrumbs>
  </div>
  <div class="bg-base-100 my-3 rounded shadow">
    <div class="flex justify-between gap-x-5 p-4">
      <x-table.search placeholder="Cari Santri" />
      <x-table.create-button label="Tambah Santri" />
    </div>
    <x-table>
      <thead>
        <tr>
          <x-table.th label="No" class="px-1 text-center" />
          <x-table.th label="Nama" />
          <x-table.th label="Kelas" />
          <x-table.th label="Nama Wali" />
          <x-table.th label="Aksi" />
        </tr>
      </thead>
      <tbody>
        @foreach ($students as $student)
          <tr wire:key="{{ $student->id }}">
            <x-table.th
              :label="$students->firstItem() + $loop->index"
              class="px-1 text-center"
            />
            <x-table.td :label="$student->name" />
            <x-table.td :label="$student->claass->name" />
            <x-table.td :label="$student->guardian_name" />
            <x-table.td class="flex items-center gap-x-2">
              <x-table.edit-action />
              <x-table.delete-action />
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
</div>
