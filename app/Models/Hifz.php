<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hifz extends Model
{
    /** @use HasFactory<\Database\Factories\HifzFactory> */
    use HasFactory;

    protected $guarded = ["id"];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }
    /**
     * Get the student that owns the Hifz
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, "student_id", "id");
    }

    /**
     * Get the surah that owns the Hifz
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function surah(): BelongsTo
    {
        return $this->belongsTo(Surah::class, "surah_id", "id");
    }
}
