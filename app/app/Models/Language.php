<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    use HasFactory;

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class);
    }
}
