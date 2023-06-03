<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Episode extends Model
{
    use HasFactory;
    protected $table = "episodes";
    protected $guarded = [];

    public function show(): BelongsTo {
        return $this->belongsTo(Show::class);
    }

    public function siblings() {
        return Episode::where("show_id", $this->show_id);
    }

    public function history(): HasMany {
        return $this->hasMany(History::class);
    }

    static function show_episodes($show) {
        return Episode::where("show_id", "=", $show);
    }
}
