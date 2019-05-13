<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->comment('标题');
            $table->string('protocol_id')->comment('协议');
            $table->string('host')->comment('主机');
            $table->string('port')->comment('端口');
            $table->text('description')->nullable()->comment('描述');

            $table->unsignedTinyInteger('sort')->default(255);
            $table->integer('created_by')->default(0);
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
        Schema::dropIfExists('servers');
    }
}
