<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create("reviews", function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("title");
            $table->longText("comment");
            $table->float("rating");

            $table->unsignedBigInteger("show_id");
            $table->unsignedBigInteger("user_id");

            $table->foreign("show_id")->references("id")->on("shows");
            $table->foreign("user_id")->references("id")->on("users");

            $table->unique(["user_id", "show_id"]);
        });
    }
    public function down() {
        Schema::dropIfExists("reviews");
    }
};
