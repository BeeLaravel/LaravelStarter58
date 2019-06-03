<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_product', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('purchase_id')->comment('采购 ID');
            $table->unsignedInteger('product_id')->comment('产品 ID');

            $table->integer('created_by')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->comment = '仓库－采购产品';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_product');
    }
}
