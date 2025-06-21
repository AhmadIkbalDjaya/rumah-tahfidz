@props([
  "searchModel",
  "dataModel",
])

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
    <x-icons.x />
  </span>
  <div
    x-show="isOpen"
    x-cloak
    class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg"
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
            class="w-full cursor-pointer px-4 py-2 text-left hover:bg-gray-100"
          >
            {{ $student->name }}
          </button>
        </li>
      @empty
        <li class="px-4 py-2 text-gray-500">Tidak ada santri ditemukan</li>
      @endforelse
    </ul>
  </div>
</div>

{{--
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
  <x-icons.x />
  </span>
  <div
  x-show="isOpen"
  x-cloak
  class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg"
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
  class="w-full cursor-pointer px-4 py-2 text-left hover:bg-gray-100"
  >
  {{ $student->name }}
  </button>
  </li>
  @empty
  <li class="px-4 py-2 text-gray-500">Tidak ada santri ditemukan</li>
  @endforelse
  </ul>
  </div>
  </div>
--}}
