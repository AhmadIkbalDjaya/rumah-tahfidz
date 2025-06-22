<button
  x-cloak
  x-data="{
    theme: null,
    toggleTheme() {
      if (this.theme == 'dark') {
        localStorage.setItem('theme', 'light')
        this.theme = 'light'
      } else {
        localStorage.setItem('theme', 'dark')
        this.theme = 'dark'
      }
      document.documentElement.setAttribute('data-theme', this.theme)
    },
    init() {
      this.theme = localStorage.getItem('theme') || 'dark'
    },
  }"
  x-on:click="toggleTheme"
  class="mx-1 cursor-pointer text-gray-500 dark:text-gray-400"
>
  <x-icons.light x-show="theme == 'dark'" class="h-6 w-6" />
  <x-icons.dark x-show="theme == 'light'" class="h-5 w-5" />
</button>
