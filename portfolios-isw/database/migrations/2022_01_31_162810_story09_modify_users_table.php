<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Story09ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // i'm scared to change this class's name :(
        Schema::create('handles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('twitter_handle')->nullable();
            $table->string('linkedin_handle')->nullable();
            $table->string('spotify_handle')->nullable();
            $table->string('discord_handle')->nullable();
            $table->string('github_handle')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('handles');
    }
}
