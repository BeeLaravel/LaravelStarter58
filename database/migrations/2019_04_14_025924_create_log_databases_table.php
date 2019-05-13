<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_databases', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->enum('operation_type', ['record', 'table', 'view', 'index', 'trigle', 'procedure', 'function', 'database'])->comment('操作类型');
            $table->enum('type', ['insert', 'delete', 'update', 'create', 'drop', 'alter', 'function', 'database'])->comment('数据库操作类型');
            $table->text('sql')->comment('SQL');
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
        Schema::dropIfExists('log_databases');
    }
}
