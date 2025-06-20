<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Claass extends Model
{
    /** @use HasFactory<\Database\Factories\ClaassFactory> */
    use HasFactory;

    protected $guarded = ["id"];

    /**
     * Get all of the students for the Claass
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class, "claass_id", "id");
    }
}
