<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkPersonRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('network_person_relations', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id')->comment('关联人'); // 妻->夫 子->父母 
            $table->unsignedBigInteger('another_person_id')->comment('被关联人');
            $table->enum('relation', ['couple', 'parent', 'classmate', 'workmate', 'friend', 'other'])->default('other')->comment('关系');
            $table->string('relation_id')->comment('关系 ID');
            $table->unsignedTinyInteger('sort')->default(255)->comment('亲密度');

            $table->comment = '社交网络-人员关系';
        });
        // 夫妻 第一任 第二任
        // 父母 亲父母 养父母 义父母
        // 同学 小学同学 初中同学 高中同学 大学同学
        // 同事 英科 木森 鸿云来 乐金所 合房网 博库 壹加壹 易仓
        // 朋友 男女朋友 普通朋友
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('network_person_relations');
    }
}
