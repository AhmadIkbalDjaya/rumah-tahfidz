<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\AuthForm;
use Livewire\Attributes\{Title, Layout};

new class extends Component {
  #[Title("Login | Rumah Tahfiz")]
  #[Layout("components.layouts.app")]
  public AuthForm $form;

  public function login()
  {
    if ($this->form->login()) {
      $this->redirectRoute("home");
    }
  }
}; ?>

<div
  class="grid h-screen w-screen place-items-center bg-green-200 bg-cover bg-center"
  style="background-image: url('/assets/images/bg-login.png')"
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
      <button type="submit" class="btn btn-success text-white">Login</button>
    </form>
  </div>
</div>
