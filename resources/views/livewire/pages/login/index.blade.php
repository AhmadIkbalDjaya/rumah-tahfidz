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
    <h2
      class="absolute -top-22 right-0 left-0 w-full text-center text-2xl font-medium text-gray-50"
    >
      Sistem Pengelolah Hafalan Al-Qur'an
    </h2>
    <form wire:submit="login" class="flex flex-col gap-y-9">
      <h2 class="mb-2 text-xl font-medium">Masuk ke Akun Anda</h2>
      <fieldset class="fieldset">
        <input
          type="text"
          wire:model.live="form.username"
          placeholder="Username"
          class="input input-success w-full"
        />
        @error("form.username")
          <x-input.error-message field="form.username" />
        @enderror
      </fieldset>
      <fieldset class="fieldset">
        <input
          type="password"
          wire:model.live="form.password"
          placeholder="password"
          class="input input-success w-full"
        />
        @error("form.password")
          <x-input.error-message field="form.password" />
        @enderror
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
