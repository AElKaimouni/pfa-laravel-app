<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create("celebrities", function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("avatar");
            $table->string("fullName");
            $table->longText("biography");
            $table->date("birthDay");
            $table->string("country");
            $table->string("keywords");
            $table->enum("role", ["director", "writer", "actor"]);
        });
    }

    public function down() {
        Schema::dropIfExists("celebrities");
    }
};
