<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_routes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->enum('type', ['system', 'application', 'module', 'controller', 'action'])->comment('操作类型');
            $table->string('url')->comment('操作类型');
            $table->string('http')->comment('HTTP 请求');
            $table->text('description')->comment('备注');
            $table->string('status')->comment('状态');
            $table->string('result')->comment('结果');

            $table->integer('created_by')->default(0);
            $table->timestamp('created_at');
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
        Schema::dropIfExists('log_routes');
    }
}
