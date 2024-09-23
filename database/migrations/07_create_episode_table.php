<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {

        Schema::create("episodes", function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("title");
            $table->longText("description");
            $table->unsignedBigInteger("show_id");
            $table->string("thumbnail");
            $table->string("video");
            $table->float("epn");
            $table -> string("duration");

            $table->foreign("show_id")->references("id")->on("shows");
            $table->unique(["epn", "show_id"]);
        });
    }

    public function down() {
        Schema::dropIfExists("episodes");
    }
};
