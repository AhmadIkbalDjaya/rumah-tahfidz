<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\AuthForm;

new class extends Component {
  public AuthForm $form;
  public function logout()
  {
    if ($this->form->logout()) {
      $this->redirectRoute("login");
    }
  }
};
?>

<div
  class="navbar bg-base-100 sticky top-0 z-20 flex min-h-12 rounded-md px-1 py-1.5 shadow-sm md:px-2.5"
>
  <div class="block flex-none md:hidden">
    <button x-on:click="toggleSidebar" class="btn btn-square btn-ghost">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="inline-block h-5 w-5 stroke-current"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4 6h16M4 12h16M4 18h7"
        />
      </svg>
    </button>
  </div>
  <div class="flex-1">
    <a
      wire:navigate
      href="{{ route("home") }}"
      class="flex w-full items-center justify-center text-xl font-semibold md:w-fit md:justify-start"
    >
      <span class="hidden md:block">Sistem Pengelolah &nbsp;</span>
      Hafalan Al-Qur'an
    </a>
  </div>
  <div class="flex gap-2">
    <button wire:click="logout" class="cursor-pointer">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="icon icon-tabler icons-tabler-outline icon-tabler-logout h-6 w-6 text-red-600"
      >
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path
          d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"
        />
        <path d="M9 12h12l-3 -3" />
        <path d="M18 15l3 -3" />
      </svg>
    </button>
  </div>
</div>
