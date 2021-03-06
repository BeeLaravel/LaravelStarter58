<?php
namespace App\Http\Controllers\Api\Warehouse;

use Illuminate\Http\Request;

use App\Http\Requests\Warehouse\CostRequest as ThisRequest;
use App\Models\Warehouse\Cost as ThisModel;
use App\Transformers\Warehouse\CostTransformer as ThisTransformer;

class CostController extends Controller { // 消费
    public function index(Request $request, $parent_id=0) {
        $order_column = $request->query('order_column', 'sort');
        $order_direction = $request->query('order_direction', 'asc');
        $page = $request->query('page', 1);
        $per_page = $request->query('per_page', 20);
        $filter = $request->query('filter', "");
        $language = $request->query('language', "");
        $category = $request->query('category', "");

        $items = new ThisModel;

        if ( $filter ) $items = $items->where(function($query) use ($filter){
            $filter = '%'.$filter.'%';

            return $query->where('title', 'like', $filter)
                ->orWhere('description', 'like', $filter)
                ->orWhere('slug', 'like', $filter);
        });
        if ( $language ) $items = $items->where('language', $language);
        if ( $category ) $items = $items->where('category', $category);
  
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
