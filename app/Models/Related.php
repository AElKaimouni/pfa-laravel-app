<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Related extends Model {
    use HasFactory;
    protected $table = "show_related";
    protected $guarded = [];

    public function show() {
        return $this->belongsTo(Show::class, "show_id");
    }

    public function related() {
        return $this->belongsTo(Show::class, "related_id");
    }
}
