<?php
namespace App\Http\Controllers\Api\Warehouse;

use Illuminate\Http\Request;

use App\Http\Requests\Warehouse\ProductRequest as ThisRequest;
use App\Models\Warehouse\Product as ThisModel;
use App\Transformers\Warehouse\ProductTransformer as ThisTransformer;

class ProductController extends Controller { // 包管理
    public function index(Request $request, $parent_id=0) {
        $order_column = $request->query('order_column', 'sort');
        $order_direction = $request->query('order_direction', 'asc');
        $page = $request->query('page', 1);
        $per_page = $request->query('per_page', 20);
        $filter = $request->query('filter', "");

        $items = new ThisModel;

        if ( $filter ) $items = $items->where(function($query) use ($filter){
            $filter = '%'.$filter.'%';

            return $query->where('title', 'like', $filter)
                ->orWhere('description', 'like', $filter)
                ->orWhere('slug', 'like', $filter);
        });
  
        $items = $items
            ->orderBy($order_column, $order_direction)
            ->orderBy('id', 'desc')
            ->paginate($per_page);

        return $this->response->paginator($items, new ThisTransformer);
    }
    public function show($id) {
        $item = ThisModel::findOrFail($id);

        return $this->response->item($item, new ThisTransformer);
    }
    public function store(ThisRequest $request) {
        $item = ThisModel::create($request->all());
        return [
            'result' => $item,
        ];
    }
    public function update(ThisRequest $request, $id) {
        $item = ThisModel::findOrFail($id);
        $result = $item->update($request->all());
        return [
            'result' => $result,
        ];
    }
    public function destroy($id) {
        $item = ThisModel::findOrFail($id);
        $result = $item->delete();

        return [
            'result' => $result,
        ];
    }
}

