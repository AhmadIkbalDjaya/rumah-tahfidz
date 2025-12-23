<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\AuthForm;
use App\Traits\Livewire\WithToast;
use Livewire\Attributes\{Title, Layout};

new class extends Component {
  use WithToast;
  #[Title("Login")]
  #[Layout("components.layouts.app")]
  public AuthForm $form;

  public function login()
  {
    if ($this->form->login()) {
      $this->redirect(route("home"), navigate: true);
      $this->toast("Login Berhasil", "success");
    } else {
      $this->toast("Username / Password Salah", "error");
    }
  }
}; ?>

<div
  class="grid h-screen w-screen place-items-center bg-[#9af5b3] bg-[url(/public/assets/images/bg-login.webp)] bg-cover bg-center dark:bg-[#00101F] dark:bg-[url(/public/assets/images/bg-login-dark.webp)]"
>
  <div
    class="bg-base-100 relative w-full rounded-xl p-10 px-5 text-center shadow md:w-md md:px-10"
  >
    <div class="mb-10">
      <div class="flex w-full items-center gap-x-1">
        <div class="rounded bg-white px-2.5">
          <img
            src="{{ asset("assets/images/logo.webp") }}"
            alt=""
            srcset=""
            class="w-12"
            loading="lazy"
          />
        </div>
        <div class="flex flex-col items-start">
          <h1 class="text-lg font-extrabold tracking-tight">
            <span
              class="bg-gradient-to-r from-green-700 to-lime-500 bg-clip-text tracking-wide text-transparent uppercase"
            >
              Rumah Tahfidz
            </span>
          </h1>
          <h1 class="h-6 text-lg font-extrabold tracking-tight">
            <span
              class="bg-gradient-to-r from-green-700 to-lime-500 bg-clip-text tracking-wide text-transparent uppercase"
            >
              Al-Fajri Makassar
            </span>
          </h1>
          <p
            class="text-start text-[8px] font-medium text-gray-400 dark:text-gray-400"
          >
            Jl. Toddoppuli Raya Timur, Perm. Ilma Green Residence PK 25
          </p>
        </div>
      </div>
    </div>
    <form wire:submit="login" class="flex flex-col gap-y-9">
      <fieldset class="fieldset">
        <label class="input input-success w-full">
          <x-icons.user-filled class="text-green-400" />
          <input
            type="text"
            wire:model.live="form.username"
            placeholder="Username"
          />
        </label>
        <x-input.error name="form.username" />
      </fieldset>
      <fieldset class="fieldset">
        <label x-data="password_show" class="input input-success w-full">
          <x-icons.lock class="text-green-400" />
          <input
            x-bind:type="show ? 'text' : 'password'"
            wire:model.live="form.password"
            placeholder="Password"
          />
          <x-icons.eye
            x-show="!show"
            x-on:click="toggle"
            class="h-6 w-6 cursor-pointer text-green-400"
          />
          <x-icons.eye-off
            x-show="show"
            x-on:click="toggle"
            class="h-6 w-6 cursor-pointer text-green-400"
          />
        </label>
        <x-input.error name="form.password" />
      </fieldset>
      <button
        wire:target="login"
        wire:loading.attr="disabled"
        type="submit"
        class="btn btn-success text-white"
      >
        <span
          wire:loading
          wire:target="login"
          class="loading loading-spinner loading-xs text-white"
        ></span>
        Login
      </button>
    </form>
  </div>
</div>
