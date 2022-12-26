<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviewusers', function (Blueprint $table) {
            $table->id();
            $table->string('uniq_id');
            $table->string('profile_url')->nullable();
            $table->string('image_url')->nullable();
            $table->string('name');
            $table->foreignId('review_id')->nullable();
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
        Schema::dropIfExists('reviewusers');
    }
}
