<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table = "show_genres";
    protected $guarded = [];

    public function show() {
        return $this->belongsTo(Show::class);
    }

    static function list() {
        return Genre::select('name')->distinct()->get()->map(function ($genre) {
            return $genre -> name;
        });
    }
}
