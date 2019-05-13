<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicSingersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_singers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title')->comment('姓名');
            $table->enum('gender', ['male', 'female', 'unknow'])->default('unknow')->comment('性别');
            $table->timestamp('birthday')->nullable()->comment('生日');
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
        Schema::dropIfExists('music_singers');
    }
}
