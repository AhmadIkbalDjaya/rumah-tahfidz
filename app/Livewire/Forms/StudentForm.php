<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class StudentForm extends Form
{
    public ?Student $student;
    #[Validate("required|max:255")]
    public $name;
    #[Validate("required|max:255")]
    public $guardian_name;
    #[Validate("required|max:255")]
    public $class_name;

    public function setStudent(Student $student): void
    {
        $this->student = $student;
        $this->name = $student->name;
        $this->guardian_name = $student->guardian_name;
        $this->class_name = $student->class_name;
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

    public function bulkDestroy(array $ids): void
    {
        Student::whereIn('id', $ids)->delete();
        $this->reset();
    }
}
