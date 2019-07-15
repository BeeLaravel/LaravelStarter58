<?php
namespace App\Console\Commands\Tool;

use Illuminate\Console\Command;

use App\Models\Structure\CategoryItem;
use App\Models\User\Category;

class DataCopy extends Command {
    protected $signature = 'tool:datacopy
        {--length=10 : Password Length}';
    protected $description = 'Copy data from One Table to Other';

    public function __construct() {
        parent::__construct();
    }
    public function handle() {
        $category_array = CategoryItem::where('category_id', 4)->get();
        $categories = level_array($category_array);
        
        $this->insert($categories);
    }
    protected function insert($categories, $parent_id=0) {
        foreach ( $categories as $key => $value ) {
            $category = Category::create([
                'title' => $value->title,
                'description' => $value->title,
                'slug' => strtolower($value->title),
                'parent_id' => $parent_id,
                'created_by' => 2,
            ]);

            if ( $value->children ) $this->insert($value->children, $category->id);
        }
    }
}
