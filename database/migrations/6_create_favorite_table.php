<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {

        Schema::create("favorites", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("show_id");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();

            $table->foreign("show_id")->references("id")->on("shows");
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    public function down() {

        Schema::dropIfExists("favorites");
    }
};
