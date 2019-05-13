<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_columns', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('table_id');
            $table->string('slug')->comment('slug');
            $table->string('title')->comment('标题');
            $table->text('description')->comment('描述');

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
        Schema::dropIfExists('database_columns');
    }
}
