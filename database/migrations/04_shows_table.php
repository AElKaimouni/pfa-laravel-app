<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create("shows", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->longText("description");
            $table->string("runTime");
            $table->string("rating");
            $table->string("keywords");
            $table->string("poster");
            $table->string("thumbnail");
            $table->date("releaseDate");
            $table->enum("type", ["TV SHOW", "Film"]);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists("show_genres");
        Schema::dropIfExists("shows");
    }
};
