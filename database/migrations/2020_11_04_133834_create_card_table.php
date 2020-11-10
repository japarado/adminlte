<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card', function (Blueprint $table) {
            $table->id();
			$table->string('code');
			$table->unsignedTinyInteger('is_synced')->default(false);
			$table->unsignedBigInteger('batch_id');
			$table->unsignedBigInteger('abbott_code_id');
			$table->unsignedBigInteger('brand_id');
            $table->timestamps();
			$table->softDeletes();

			$table->foreign('batch_id')->references('id')->on('batch');
			$table->foreign('abbott_code_id')->references('id')->on('abbott_code');
			$table->foreign('brand_id')->references('id')->on('brand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card');
    }
}
