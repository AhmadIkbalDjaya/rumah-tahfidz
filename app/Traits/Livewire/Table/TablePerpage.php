<?php

namespace App\Traits\Livewire\Table;

use Livewire\WithPagination;

trait TablePerpage
{
    use WithPagination;
    public $perpage = 10;
    public function updatingPerpage()
    {
        $this->resetPage();
    }
}
