<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_image', function (Blueprint $table) {
            $table->id();
			$table->string('url');
			$table->string('code');
			$table->timestamp('expires_at')->nullable();
			$table->unsignedBigInteger('card_id');
            $table->timestamps();
			$table->softDeletes();

			$table->foreign('card_id')->references('id')->on('card');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_image');
    }
}
