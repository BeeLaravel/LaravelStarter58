<?php
namespace App\Http\Controllers\Api\Structure;

use Illuminate\Http\Request;

use App\Models\Structure\CategoryItem;
use App\Transformers\Structure\CategoryItemTransformer;

class CategoryItemController extends Controller { // 案例
    public function index(Request $request) {
        $order_column = $request->query('order_column', 'sort');
        $order_direction = $request->query('order_direction', 'asc');
        $per_page = $request->query('per_page', 20);

        $category_id = $request->query('category_id', 0);
        $parent_id = $request->query('parent_id', 0);

        $category_items = new CategoryItem;

        if ( $category_id ) $category_items = $category_items->where('category_id', $category_id);
        if ( $parent_id ) $category_items = $category_items->where('parent_id', $parent_id);
  
        $category_items = $category_items
            ->orderBy($order_column, $order_direction)
            ->orderBy('id', 'desc')
            ->paginate($per_page);

        return $this->response->paginator($category_items, new CategoryItemTransformer);
    }
    public function show($id) {
        $category_item = CategoryItem::findOrFail($id);

        return $this->response->item($category_item, new CategoryItemTransformer);
    }
    public function store(Request $request) {
        $category_item = CategoryItem::create();
    }
    public function update(Request $request, $id) {
        $category_item = CategoryItem::findOrFail($id);
        $category_item->update();
    }
    public function destroy($id) {
        $category_item = CategoryItem::findOrFail($id);
        $result = $category_item->delete();

        return [
            'result' => $result,
        ];
    }
}
