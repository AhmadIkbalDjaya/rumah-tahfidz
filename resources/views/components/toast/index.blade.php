<div
  x-data="{
    show: false,
    message: null,
    timer: null,
    type: 'info',
    showToast(event) {
      let toast = event.detail.toast
      this.message = toast.message
      this.show = true
      this.type = toast.type

      clearTimeout(this.timer)

      if (toast.timeout && toast.timeout > 0) {
        this.timer = setTimeout(() => {
          this.show = false
        }, toast.timeout)
      }
    },
  }"
  x-init="window.addEventListener('toast', (event) => showToast(event))"
  x-show="show"
  x-cloak
  x-transition:enter="transition duration-300 ease-out"
  x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100"
  x-transition:leave="transition duration-300 ease-in"
  x-transition:leave-start="opacity-100"
  x-transition:leave-end="opacity-0"
  class="toast z-20"
>
  <div
    class="alert alert-soft flex min-w-64 items-center justify-between"
    :class="{
      'alert-info': type == 'info',
      'alert-success': type == 'success',
      'alert-warning': type == 'warning',
      'alert-error': type == 'error',
    }"
  >
    <template x-if="type == 'info'">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        class="h-6 w-6 shrink-0 stroke-current"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
        ></path>
      </svg>
    </template>
    <template x-if="type == 'success'">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 shrink-0 stroke-current"
        fill="none"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
        />
      </svg>
    </template>
    <template x-if="type == 'warning'">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 shrink-0 stroke-current"
        fill="none"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
        />
      </svg>
    </template>
    <template x-if="type == 'error'">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-6 w-6 shrink-0 stroke-current"
        fill="none"
        viewBox="0 0 24 24"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
        />
      </svg>
    </template>
    <span x-text="message" class="grow text-start"></span>
    <x-icons.x x-on:click="show = false" class="cursor-pointer text-inherit" />
  </div>
  <script>
    window.toast = function (payload) {
      window.dispatchEvent(new CustomEvent('toast', { detail: payload }));
    };
  </script>
</div>
