<?php
namespace App\Transformers\Structure;

use League\Fractal\TransformerAbstract;

use App\Models\Structure\CategoryItem;

class CategoryItemTransformer extends TransformerAbstract {
    // protected $availableIncludes = ['category'];

    public function transform(CategoryItem $category_item) {
        return [
            'id' => $category_item->id,

            'title' => $category_item->title,
            'description' => $category_item->description,
            'category' => $category_item->category,
            // 'sort' => $category_item->sort,

            // 'created_at' => $category_item->created_at,
            // 'updated_at' => $category_item->updated_at,
            // 'deleted_at' => $category_item->deleted_at,

            // 'created_by' => $category_item->created_by,
            // 'updated_by' => $category_item->updated_by,
            // 'deleted_by' => $category_item->deleted_by,
        ];
    }

    // public function includeCategory(CategoryItem $category_item) { // 科室
    //     return $this->item($category_item->category, new CategoryTransformer());
    // }
}