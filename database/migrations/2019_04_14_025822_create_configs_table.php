<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('type', ['system', 'application', 'module', 'organization', 'department', 'site', 'role', 'user'])->comment('类型');
            $table->string('unique_slug')->comment('唯一标识 ID');
            $table->string('key')->comment('键');
            $table->string('value')->comment('值');

            $table->integer('created_by')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->comment = '配置';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
