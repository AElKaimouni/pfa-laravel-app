<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celebrity extends Model {
    use HasFactory;
    protected $table = "celebrities";
    protected $guarded = [];
}
