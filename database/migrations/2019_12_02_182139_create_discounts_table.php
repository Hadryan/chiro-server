<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->enum('type', ['fixed', 'percent']);
            $table->enum('on', ['product', 'category', 'shipping_city', 'user', 'all']);
            $table->bigInteger('target_id')->nullable();
            $table->bigInteger('lower_limit')->nullable();
            $table->bigInteger('amount');
            $table->boolean('exclusive');
            $table->text('description')->nullable();

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
        Schema::dropIfExists('discounts');
    }
}
