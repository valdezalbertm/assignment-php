<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Key;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function key(): BelongsTo
    {
        return $this->belongsTo(Key::class);
    }
}
