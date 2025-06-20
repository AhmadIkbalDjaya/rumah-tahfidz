@props([
  "model" => "perpage",
  "options" => [5, 10, 20, 50],
])
<form class="flex grow items-center justify-start gap-x-3">
  <label
    for="perpage"
    class="hidden text-sm font-medium text-gray-900 md:block dark:text-white"
  >
    Perpage
  </label>
  <select wire:model.live="{{ $model }}" class="select select-sm w-28">
    @foreach ($options as $option)
      <option value="{{ $option }}">{{ $option }}</option>
    @endforeach
  </select>
</form>
