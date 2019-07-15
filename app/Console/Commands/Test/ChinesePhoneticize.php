<?php
namespace App\Console\Commands\Test;

use Overtrue\Pinyin\Pinyin;

class ChinesePhoneticize extends Command {
    protected $signature = 'test:pinyin';
    protected $description = 'Pinyin 拼音';

    public function __construct() {
        parent::__construct();
    }
    public function handle() {
    	$pinyin = new Pinyin(); // 小内存型(默认)
		// $pinyin = new Pinyin('Overtrue\Pinyin\MemoryFileDictLoader'); // 内存型
		// $pinyin = new Pinyin('Overtrue\Pinyin\GeneratorFileDictLoader'); // I/O型

    	// $result = $pinyin->convert('带着希望去旅行，比到达终点更美好');
    	// $result = $pinyin->convert('带着希望去旅行，比到达终点更美好', PINYIN_TONE);
    	// $result = $pinyin->convert('带着希望去旅行，比到达终点更美好', PINYIN_ASCII_TONE);

    	$result = $pinyin->abbr('你好2018！', PINYIN_KEEP_NUMBER); // nh2018 保留数字
		// $result = $pinyin->abbr('Happy New Year! 2018！', PINYIN_KEEP_ENGLISH); // HNY2018 保留英文

		// $result = $pinyin->sentence('带着希望去旅行，比到达终点更美好！');
		// $result = $pinyin->sentence('带着希望去旅行，比到达终点更美好！', PINYIN_TONE);

		// $result = $pinyin->name('单某某');
		// $result = $pinyin->name('单某某', PINYIN_TONE);

		// $result = $pinyin->permalink('带着希望去旅行');
		// $result = $pinyin->permalink('带着希望去旅行', '.');

		// $result = $pinyin->abbr('带着希望去旅行');
		// $result = $pinyin->abbr('带着希望去旅行', '-');

    	print_r($result);
    }
}
// PINYIN_NO_TONE # 无音调
// PINYIN_TONE # UNICODE 式音调
// PINYIN_ASCII_TONE # 数字式音调

// PINYIN_KEEP_NUMBER	保留数字
// PINYIN_KEEP_ENGLISH	保留英文
// PINYIN_KEEP_PUNCTUATION	保留标点
// PINYIN_UMLAUT_V	使用 v 代替 yu, 例如：吕 lyu 将会转为 lv
