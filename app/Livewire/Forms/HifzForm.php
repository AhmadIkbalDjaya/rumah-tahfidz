<?php

namespace App\Livewire\Forms;

use App\Models\Hifz;
use Livewire\Attributes\Validate;
use Livewire\Form;

class HifzForm extends Form
{
    public ?Hifz $hifz;
    #[Validate("required|exists:students,id")]
    public string $student_id;
    #[Validate("required|exists:surahs,id")]
    public string $surah_id;
    #[Validate("required|numeric|min:1|max:114")]
    public $verse_start;
    #[Validate("required|integer|min:1|max:114")]
    public $verse_end;
    #[Validate("required|integer|min:1|max:100")]
    public $review_count;
    #[Validate("required|max:255")]
    public $score;
    #[Validate("required|date")]
    public $recorded_at;

    public function setHifz(Hifz $hifz): void
    {
        $this->hifz = $hifz;
        $this->student_id = $hifz->student_id;
        $this->surah_id = $hifz->surah_id;
        $this->verse_start = $hifz->verse_start;
        $this->verse_end = $hifz->verse_end;
        $this->review_count = $hifz->review_count;
        $this->score = $hifz->score;
        $this->recorded_at = $hifz->recorded_at;
    }

    public function store(): void
    {
        $validated = $this->validate();
        Hifz::create($validated);
        $this->reset();
    }

    public function update(): void
    {
        $validated = $this->validate();
        $this->hifz->update($validated);
        $this->reset();
    }

    public function delete(): void
    {
        $this->hifz->delete();
        $this->reset();
    }
}
