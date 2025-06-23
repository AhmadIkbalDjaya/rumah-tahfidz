<div
  {{ $attributes->merge(["class" => "dropdown dropdown-end"]) }}
>
  <button
    tabindex="0"
    role="button"
    class="btn btn-sm btn-outline border-gray-300 dark:border-gray-600"
  >
    <span class="hidden md:block">Aksi Massal</span>
    <x-icons.dots-vertical class="h-3 w-fit" />
  </button>
  <ul
    tabindex="0"
    class="menu menu-sm dropdown-content bg-base-100 rounded-box border-base-100 z-1 w-40 border p-1 shadow-sm dark:border-gray-500/50 [&_li>*]:hover:bg-red-100/50 [&_li>*]:dark:hover:bg-red-100/25"
  >
    {{ $slot }}
  </ul>
</div>
