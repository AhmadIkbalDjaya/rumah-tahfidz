<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route("", "pages.dashboard.index")->name("home");
Volt::route("students", "pages.students.index")->name("students.index");
Volt::route("hifz", "pages.hifz.index")->name("hifz.index");