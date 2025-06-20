<x-layouts.app>
  <x-slot:title>
    {{ $title ?? "" }}
  </x-slot>
  <div
    x-data="{
      sidebarOpen: false,
      toggleSidebar() {
        this.sidebarOpen = ! this.sidebarOpen
        console.log(this.sidebarOpen)
      },
      closeSidebar() {
        this.sidebarOpen = false
      },
    }"
    class="box-border block h-screen w-screen items-stretch overflow-y-auto bg-green-900/5 p-1 md:flex md:gap-x-2 md:p-2.5 dark:bg-green-100/3"
  >
    <x-base.sidebar />
    <div class="grow">
      <x-base.navbar />
      <div class="py-1">
        {{ $slot }}
      </div>
    </div>
  </div>
</x-layouts.app>
