<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create("show_related", function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger("show_id");
            $table->unsignedBigInteger("related_id");

            $table->foreign("show_id")->references("id")->on("shows");
            $table->foreign("related_id")->references("id")->on("shows");

            $table->unique(["related_id", "show_id"]);
        });
    }
    public function down() {
        Schema::dropIfExists("show_related");
    }
};
