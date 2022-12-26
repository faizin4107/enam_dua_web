<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBussinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bussinesses', function (Blueprint $table) {
            $table->id();
            $table->string('uniq_id');
            $table->string('alias');
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->boolean('is_closed');
            $table->string('url')->nullable();
            $table->bigInteger('review_count');
            $table->float('rating');
            $table->string('price')->nullable();
            $table->string('phone');
            $table->string('display_phone');
            $table->float('distance');
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
        Schema::dropIfExists('bussinesses');
    }
}
