<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StudentForm extends Form
{
    public ?Student $student;
    #[Validate("required|max:255")]
    public $name;
    #[Validate("required|exists:claasses,id")]
    public $claass_id;
    #[Validate("required|max:255")]
    public $guardian_name;

    public function setStudent(Student $student): void
    {
        $this->student = $student;
        $this->name = $student->name;
        $this->claass_id = $student->claass_id;
        $this->guardian_name = $student->guardian_name;
    }

    public function store(): void
    {
        $validated = $this->validate();
        Student::create($validated);
        $this->reset();
    }

    public function update(): void
    {
        $validated = $this->validate();
        $this->student->update($validated);
        $this->reset();
    }

    public function destroy(): void
    {
        $this->student->delete();
        $this->reset();
    }
}
