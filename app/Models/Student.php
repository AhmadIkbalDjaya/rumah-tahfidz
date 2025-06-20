<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $guarded = ["id"];

    /**
     * Get the claass that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function claass(): BelongsTo
    {
        return $this->belongsTo(Claass::class, "claass_id", "id");
    }

    /**
     * Get all of the hifzs for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hifzs(): HasMany
    {
        return $this->hasMany(Hifz::class, "student_id", "id");
    }
}
