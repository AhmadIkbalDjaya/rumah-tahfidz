<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route("", "pages.dashboard.index")->name("home");
Route::prefix("students")->name("students.")->group(function () {
  Volt::route("", "pages.students.index")->name("index");
  Volt::route("create", "pages.students.create")->name("create");
  Volt::route("{student}/edit", "pages.students.edit")->name("edit");
});
Route::prefix("hifz")->name("hifz.")->group(function () {
  Volt::route("", "pages.hifz.index")->name("index");
  Volt::route("create", "pages.hifz.create")->name("create");
  Volt::route("{hifz}/edit", "pages.hifz.edit")->name("edit");
});