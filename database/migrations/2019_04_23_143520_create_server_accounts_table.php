<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_accounts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->comment('标识');
            $table->string('title')->comment('标题');
            $table->string('account')->comment('账户');
            $table->string('password')->comment('密码');
            $table->string('config')->comment('配置'); // database[database|charset|collation]|ssh
            $table->text('description')->nullable()->comment('描述');
            $table->string('server_id')->comment('服务 ID');

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
        Schema::dropIfExists('server_accounts');
    }
}
