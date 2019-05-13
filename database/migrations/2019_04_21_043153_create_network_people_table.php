<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_people', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')->comment('姓名');
            $table->text('description')->comment('简介');
            $table->timestamp('birth')->nullable()->comment('出生时间');
            $table->enum('gender', ['male', 'female', 'unknow'])->default('unknow')->comment('性别');

            $table->unsignedTinyInteger('sort')->default(255);
            $table->integer('created_by')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->comment = '社交网络-人员';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_people');
    }
}
