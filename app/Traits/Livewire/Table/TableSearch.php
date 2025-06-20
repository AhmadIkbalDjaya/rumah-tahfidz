<?php

namespace App\Traits\Livewire\Table;

use Livewire\Attributes\Url;
use Livewire\WithPagination;

trait TableSearch
{
    use WithPagination;
    
    #[Url(as: 'query')]
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
