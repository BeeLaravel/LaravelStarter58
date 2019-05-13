<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_protocols', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->comment('标识');
            $table->string('title')->comment('标题');
            $table->enum('type', ['web', 'file', 'netfile', 'oss', 'database', 'cache', 'queue', 'searchengine', 'versioncontrol'])->comment('类型');
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
        Schema::dropIfExists('server_protocols');
    }
}
