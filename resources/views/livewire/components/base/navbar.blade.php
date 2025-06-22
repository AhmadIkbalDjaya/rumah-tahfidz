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
      <x-icons.menu class="h-5 w-5" />
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
      <x-icons.logout class="h-6 w-6 text-red-600" />
    </button>
  </div>
</div>
