<?php

use App\Models\Hifz;
use Livewire\Volt\{Component};
use Livewire\Attributes\{Title, Layout};

new class extends Component {
  #[Title("Dashboard")]
  #[Layout("components.layouts.base")]
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
      ->orderBy("recorded_at", "DESC")
      ->limit(5)
      ->get();

    return [
      "hifzs" => $hifzs,
    ];
  }
}; ?>

<div>
  <h3 class="text-lg font-medium">Dashboard</h3>
  <div class="bg-base-100 my-3 rounded shadow">
    <div class="flex justify-between gap-x-5 p-4">
      <h2 class="text-base font-medium">Baru Saja Diakses</h2>
      <a wire:navigate href="{{ route("hifz.index") }}">
        <button class="btn btn-sm btn-success text-white">
          <span class="hidden md:block">Lihat Lainnya</span>
          <x-icons.arrow-right class="h-4 w-4" />
        </button>
      </a>
    </div>
    <x-table>
      <thead>
        <tr>
          <x-table.th class="px-3 text-center">No</x-table.th>
          <x-table.th label="Nama" />
          <x-table.th label="Zidayah" />
          <x-table.th label="Muroja'ah" class="text-center" />
          <x-table.th label="Nilai" class="text-center" />
          <x-table.th label="Waktu Menghafal" />
        </tr>
      </thead>
      <tbody>
        @foreach ($hifzs as $hifz)
          <tr wire:key="{{ $hifz->id }}">
            <x-table.th :label="1 + $loop->index" class="px-3 text-center" />
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
          </tr>
        @endforeach
      </tbody>
    </x-table>
  </div>
</div>
