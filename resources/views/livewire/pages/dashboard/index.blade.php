<?php

use Livewire\Volt\{Component};
use Livewire\Attributes\{Title, Layout};

new class extends Component {
  #[Title("Rumah Tahfiz")]
  #[Layout("components.layouts.base")]
  public function with(): array
  {
    return [];
  }
}; ?>

<div>Dashboard</div>
