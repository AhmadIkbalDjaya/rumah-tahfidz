<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Surah extends Model
{
    protected $guarded = ["id"];

    /**
     * Get all of the hifzs for the Surah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hifzs(): HasMany
    {
        return $this->hasMany(Hifz::class, "surah_id", "id");
    }
}
