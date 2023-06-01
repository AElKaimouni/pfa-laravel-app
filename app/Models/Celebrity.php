<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Celebrity extends Model {
    use HasFactory;
    protected $table = "celebrities";
    protected $guarded = [];

    public function shows(): HasMany {
        return $this->hasMany(ShowCelebrity::class);
    } 
}
