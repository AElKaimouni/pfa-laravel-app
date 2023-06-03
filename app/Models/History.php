<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    use HasFactory;
    protected $table = "history";
    protected $guarded = [];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function episode(): BelongsTo {
        return $this->belongsTo(Episode::class);
    }

    static function viewsCount($t1, $t2) {

        return History::whereBetween("created_at", [date("Y-m-d", strtotime($t1)), date("Y-m-d", strtotime($t2))])->count();
    }

    static function monthlyViews() {
        return [
            History::viewsCount("first day of January", "first day of February"),
            History::viewsCount("first day of February", "first day of march"),
            History::viewsCount("first day of march", "first day of April"),
            History::viewsCount("first day of April", "first day of May"),
            History::viewsCount("first day of May", "first day of June"),
            History::viewsCount("first day of June", "first day of July"),
            History::viewsCount("first day of July", "first day of August"),
            History::viewsCount("first day of August", "first day of September"),
            History::viewsCount("first day of September", "first day of October"),
            History::viewsCount("first day of October", "first day of November"),
            History::viewsCount("first day of November", "first day of December"),
            History::viewsCount("first day of December", "first day of January next year"),
        ];
    }


}
