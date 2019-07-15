<?php
namespace App\Console\Commands\Tool;

use Illuminate\Console\Command;

use App\Models\Structure\CategoryItem;
use App\Models\User\Category;

class DataCopy2 extends Command {
	protected $signature = 'tool:datacopy2
		{--length=10 : Password Length}';
	protected $description = 'Copy data from text to Database';

	public function __construct() {
		parent::__construct();
	}
	public function handle() {
		$categories = [];
		$data = [];

		$file = fopen("E://category.txt", "r") or die("文件路径不正确");

		while ( $line = fgets($file) ) {
			if ( substr($line, 0, 1) != '	' ) {
				$temp = ['title' => $line];

				if ( $data ) {
					$temp['children'] = $data;
					$data = [];
				}

				$categories[] = $temp;
			} else {
				$data[] = ['title' => substr($line, 1)];
			}
		}

		fclose($file);
		
		$this->insert($categories);
	}
	protected function insert($categories, $parent_id=0) {
		foreach ( $categories as $key => $value ) {
			$category = Category::create([
				'title' => $value['title'],
				'description' => $value['title'],
				'slug' => strtolower($value['title']),
				'parent_id' => $parent_id,
				'created_by' => 0,
                'type' => 'hospital',
			]);

			if ( isset($value['children']) ) $this->insert($value['children'], $category->id);
		}
	}
}
