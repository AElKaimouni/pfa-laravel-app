<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {

        Schema::create("show_genres", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger("show_id");
            $table->timestamps();

            $table->foreign("show_id")->references("id")->on("shows");
        });
    }

    public function down() {

        Schema::dropIfExists("show_genres");
    }
};
