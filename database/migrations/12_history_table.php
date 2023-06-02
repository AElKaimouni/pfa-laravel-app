<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create("history", function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger("episode_id");
            $table->unsignedBigInteger("user_id");

            $table->foreign("episode_id")->references("id")->on("episodes");
            $table->foreign("user_id")->references("id")->on("users");
        });
    }
    public function down() {
        Schema::dropIfExists("history");
    }
};
