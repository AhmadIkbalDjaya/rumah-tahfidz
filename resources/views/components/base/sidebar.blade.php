<aside
  class="width md:bg-base-100 fixed top-0 right-0 bottom-0 left-0 z-50 h-screen w-screen bg-black/50 shadow-sm md:sticky md:top-0 md:h-full md:w-60 md:rounded-md md:p-1.5"
  x-bind:class="{
    'hidden md:block': ! sidebarOpen,
    'block md:block': sidebarOpen,
  }"
  x-on:click.self="closeSidebar"
>
  <div
    class="bg-base-100 flex h-screen w-60 flex-col justify-between p-1.5 md:h-full md:w-full md:bg-transparent md:p-0"
  >
    <div class="px-2">
      <a href="{{ route("home") }}" class="flex items-center gap-x-0.5">
        <div class="rounded bg-white px-1.5">
          <img
            src="{{ asset("assets/images/logo.webp") }}"
            alt=""
            srcset=""
            class="w-9"
            loading="lazy"
          />
        </div>
        <div class="flex flex-col items-start">
          <h1 class="text-md h-5 font-extrabold tracking-tight">
            <span
              class="bg-gradient-to-r from-green-700 to-lime-500 bg-clip-text tracking-wide text-transparent uppercase"
            >
              Rumah Tahfidz
            </span>
          </h1>
          <h1 class="h-5 text-sm font-extrabold tracking-tight">
            <span
              class="bg-gradient-to-r from-green-700 to-lime-500 bg-clip-text tracking-wide text-transparent uppercase"
            >
              Al-Fajri Makassar
            </span>
          </h1>
          <p
            class="text-start text-[6px] font-medium tracking-tight text-gray-400 dark:text-gray-400"
          >
            Jl. Toddoppuli Raya Timur, Perm. Ilma Green Residence PK 25
          </p>
        </div>
      </a>
    </div>
    <ul class="my-5 grow">
      <li
        class="{{ Request::is("/") ? "bg-green-50 dark:bg-green-400/25" : "" }} group relative mx-2.5 mb-2 rounded-md px-2 py-1 text-gray-600 hover:bg-green-50 dark:text-gray-400 dark:hover:bg-green-400/25"
      >
        <a
          wire:navigate
          href="{{ route("home") }}"
          class="flex items-center gap-x-2.5"
        >
          <span
            class="{{ Request::is("/") ? "block" : "hidden" }} absolute top-0 -ms-6 h-full w-1 rounded-r-md bg-green-400 group-hover:block dark:bg-green-400/25"
          ></span>
          <x-icons.layout-dashboard
            class="h-6 w-6 {{ Request::is('/') ? 'text-green-400 dark:text-white' : '' }} group-hover:text-green-400 dark:group-hover:text-white"
          />
          <p
            class="{{ Request::is("/") ? "font-sans font-medium text-gray-800 dark:text-white" : "font-mono font-normal text-inherit" }} text-lg group-hover:font-sans group-hover:font-medium group-hover:text-gray-800 dark:group-hover:text-white"
          >
            Dahsboard
          </p>
        </a>
      </li>
      <li
        class="{{ Request::is("students*") ? "bg-green-50 dark:bg-green-400/25" : "" }} group relative mx-2.5 mb-2 rounded-md px-2 py-1 text-gray-600 hover:bg-green-50 dark:text-gray-400 dark:hover:bg-green-400/25"
      >
        <a
          wire:navigate
          href="{{ route("students.index") }}"
          class="flex gap-x-2.5"
        >
          <span
            class="{{ Request::is("students*") ? "block" : "hidden" }} absolute top-0 -ms-6 h-full w-1 rounded-r-md bg-green-400 group-hover:block dark:bg-green-400/25"
          ></span>
          <x-icons.users
            class="h-6 w-6 {{ Request::is('students*') ? 'text-green-400 dark:text-white' : '' }} group-hover:text-green-400 dark:group-hover:text-white"
          />
          <p
            class="{{ Request::is("students*") ? "font-sans font-medium text-gray-800 dark:text-white" : "font-mono font-normal text-inherit" }} text-lg group-hover:font-sans group-hover:font-medium group-hover:text-gray-800 dark:group-hover:text-white"
          >
            Daftar Santri
          </p>
        </a>
      </li>
      <li
        class="{{ Request::is("hifz*") ? "bg-green-50 dark:bg-green-400/25" : "" }} group relative mx-2.5 mb-2 rounded-md px-2 py-1 text-gray-600 hover:bg-green-50 dark:text-gray-400 dark:hover:bg-green-400/25"
      >
        <a
          wire:navigate
          href="{{ route("hifz.index") }}"
          class="flex gap-x-2.5"
        >
          <span
            class="{{ Request::is("hifz*") ? "block" : "hidden" }} absolute top-0 -ms-6 h-full w-1 rounded-r-md bg-green-400 group-hover:block dark:bg-green-400/25"
          ></span>
          <x-icons.books
            class="h-6 w-6 {{ Request::is('hifz*') ? 'text-green-400 dark:text-white' : '' }} group-hover:text-green-400 dark:group-hover:text-white"
          />
          <p
            class="{{ Request::is("hifz*") ? "font-sans font-medium text-gray-800 dark:text-white" : "font-mono font-normal text-inherit" }} text-lg group-hover:font-sans group-hover:font-medium group-hover:text-gray-800 dark:group-hover:text-white"
          >
            Daftar Hafalan
          </p>
        </a>
      </li>
    </ul>
  </div>
</aside>
