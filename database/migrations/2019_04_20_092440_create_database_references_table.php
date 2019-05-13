<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_references', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('database_id');
            $table->unsignedInteger('table_id');
            $table->unsignedInteger('column_id');
            $table->unsignedInteger('reference_table_id');
            $table->unsignedInteger('reference_column_id');
            $table->text('description')->comment('描述');

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
        Schema::dropIfExists('database_references');
    }
}
