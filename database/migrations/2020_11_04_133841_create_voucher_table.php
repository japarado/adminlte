<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->id();
			$table->string('code');
			$table->unsignedDouble('discount_value');
			$table->tinyInteger('is_amount')->default(false);
			$table->unsignedBigInteger('brand_id');
			$table->unsignedBigInteger('batch_id');
            $table->timestamps();
			$table->softDeletes();

			$table->foreign('brand_id')->references('id')->on('brand');
			$table->foreign('batch_id')->references('id')->on('batch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher');
    }
}
