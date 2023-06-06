<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("f_name")->default("");
            $table->string("l_name")->default("");
            $table->string("avatar")->default("default-user-image.png");
            $table->string("email")->unique();
            $table->string("password");
            $table->enum("role", ["user", "admin"]);
            $table->timestamp("email_verified_at")->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("users");
    }
};
