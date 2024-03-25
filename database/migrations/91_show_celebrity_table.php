<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create("show_celebrity", function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("role");

            $table->unsignedBigInteger("show_id");
            $table->unsignedBigInteger("celebrity_id");

            $table->foreign("show_id")->references("id")->on("shows");
            $table->foreign("celebrity_id")->references("id")->on("celebrities");
        });
    }
    public function down() {
        Schema::dropIfExists("show_celebrity");
    }
};
