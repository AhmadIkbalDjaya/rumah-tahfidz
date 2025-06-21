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
    <div class="flex items-center gap-x-2.5">
      <img
        src="{{ asset("assets/images/logo.png") }}"
        alt=""
        srcset=""
        class="h-10 w-10"
      />
      <div class="text-lg font-semibold">
        <h5>Ponpes DDI</h5>
        <p class="-mt-1">Darun Jannah</p>
      </div>
    </div>
    <ul class="my-5 grow">
      <li
        class="{{ Request::is("/") ? "bg-green-50" : "" }} group relative mx-2.5 mb-2 rounded-md px-2 py-1 text-gray-600 hover:bg-green-50"
      >
        <a href="{{ route("home") }}" class="flex items-center gap-x-2.5">
          <span
            class="{{ Request::is("/") ? "block" : "hidden" }} absolute top-0 -ms-6 h-full w-1 rounded-r-md bg-green-400 group-hover:block"
          ></span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="{{ Request::is("/") ? "text-green-400" : "" }} icon icon-tabler icons-tabler-outline icon-tabler-layout-dashboard h-6 w-6 group-hover:text-green-400"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
              d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1"
            />
            <path
              d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1"
            />
            <path
              d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1"
            />
            <path
              d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1"
            />
          </svg>
          <p
            class="{{ Request::is("/") ? "font-sans font-medium text-gray-800" : "font-mono font-normal text-inherit" }} text-lg group-hover:font-sans group-hover:font-medium group-hover:text-gray-800"
          >
            Dahsboard
          </p>
        </a>
      </li>
      <li
        class="{{ Request::is("students*") ? "bg-green-50" : "" }} group relative mx-2.5 mb-2 rounded-md px-2 py-1 text-gray-600 hover:bg-green-50"
      >
        <a href="{{ route("students.index") }}" class="flex gap-x-2.5">
          <span
            class="{{ Request::is("students*") ? "block" : "hidden" }} absolute top-0 -ms-6 h-full w-1 rounded-r-md bg-green-400 group-hover:block"
          ></span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="{{ Request::is("students*") ? "text-green-400" : "" }} icon icon-tabler icons-tabler-outline icon-tabler-users h-6 w-6 group-hover:text-green-400"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
          </svg>
          <p
            class="{{ Request::is("students*") ? "font-sans font-medium text-gray-800" : "font-mono font-normal text-inherit" }} text-lg group-hover:font-sans group-hover:font-medium group-hover:text-gray-800"
          >
            Daftar Santri
          </p>
        </a>
      </li>
      <li
        class="{{ Request::is("hifz*") ? "bg-green-50" : "" }} group relative mx-2.5 mb-2 rounded-md px-2 py-1 text-gray-600 hover:bg-green-50"
      >
        <a href="{{ route("hifz.index") }}" class="flex gap-x-2.5">
          <span
            class="{{ Request::is("hifz*") ? "block" : "hidden" }} absolute top-0 -ms-6 h-full w-1 rounded-r-md bg-green-400 group-hover:block"
          ></span>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="{{ Request::is("hifz*") ? "text-green-400" : "" }} icon icon-tabler icons-tabler-outline icon-tabler-books h-6 w-6 group-hover:text-green-400"
          >
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path
              d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"
            />
            <path
              d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"
            />
            <path d="M5 8h4" />
            <path d="M9 16h4" />
            <path
              d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z"
            />
            <path d="M14 9l4 -1" />
            <path d="M16 16l3.923 -.98" />
          </svg>
          <p
            class="{{ Request::is("hifz*") ? "font-sans font-medium text-gray-800" : "font-mono font-normal text-inherit" }} text-lg group-hover:font-sans group-hover:font-medium group-hover:text-gray-800"
          >
            Daftar Hafalan
          </p>
        </a>
      </li>
    </ul>
  </div>
</aside>
