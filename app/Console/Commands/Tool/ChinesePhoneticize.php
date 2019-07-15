<?php
namespace App\Console\Commands\Tool;

use Illuminate\Console\Command;

use Overtrue\Pinyin\Pinyin;

class ChinesePhoneticize extends Command {
    protected $signature = 'tool:phoneticize';
    protected $description = 'Chinese Phoneticize 中文音标化';

    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        $pinyin = new Pinyin();

        $categories = \App\Models\User\Category::where('created_by', 0)->get();

        foreach ( $categories as $category ) {
        	$category->slug = $pinyin->permalink($category->slug, '');
        	$category->save();
        }
    }
}
