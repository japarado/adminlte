<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('phone_number')->unique();
			$table->string('email')->unique()->nullable();
			$table->unsignedBigInteger('contactable_id');
			$table->string('contactable_type');
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
