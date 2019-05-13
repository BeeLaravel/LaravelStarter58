<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musics', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')->comment('标题');
            $table->text('poem')->comment('歌词');
            $table->text('lyric')->comment('歌词');
            $table->text('description')->nullable()->comment('描述');
            $table->unsignedBigInteger('view_times')->default(0)->comment('聆听次数');
            $table->unsignedBigInteger('favor_times')->default(0)->comment('喜爱次数');
            $table->unsignedBigInteger('save_times')->default(0)->comment('收藏次数');

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
        Schema::dropIfExists('musics');
    }
}
