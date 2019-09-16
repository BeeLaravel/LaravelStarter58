<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->string('extension')->comment('扩展');
            $table->string('mime')->comment('元数据');
            $table->integer('size')->comment('大小');
            $table->string('category')->comment('分类');
            $table->string('url')->comment('URL');
            $table->string('md5')->comment('MD5');
            $table->string('sha1')->comment('SHA1');

            $table->unsignedInteger('created_by')->default(0);
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
        Schema::dropIfExists('resource_files');
    }
}
