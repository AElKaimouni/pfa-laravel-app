<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowCelebrity extends Model {
    use HasFactory;
    protected $table = "show_celebrity";
    protected $guarded = [];

    public function show() {
        return $this->belongsTo(Show::class, "show_id");
    }

    public function celebrity() {
        return $this->belongsTo(Celebrity::class, "celebrity_id");
    }
}
