<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInboundProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbound_product', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('inbound_id')->comment('入库单 ID');
            $table->unsignedInteger('product_id')->comment('产品 ID');

            $table->integer('created_by')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->comment = '仓库－入库单产品';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inbound_product');
    }
}
