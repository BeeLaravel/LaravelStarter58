<?php
namespace App\Http\Controllers\Api\Tool;

use Illuminate\Http\Request;

use App\Http\Requests\Tool\CustomFontRequest as ThisRequest;
use App\Models\Tool\CustomFont as ThisModel;
use App\Transformers\Tool\CustomFontTransformer as ThisTransformer;

class CustomFontController extends Controller { // 包管理
    public function index(Request $request, $parent_id=0) {
        $order_column = $request->query('order_column', 'sort');
        $order_direction = $request->query('order_direction', 'asc');
        $page = $request->query('page', 1);
        $per_page = $request->query('per_page', 20);
        $filter = $request->query('filter', "");
        $font_id = $request->query('font_id', "");

        $items = new ThisModel;

        if ( $filter ) $items = $items->where(function($query) use ($filter){
            $filter = '%'.$filter.'%';

            return $query->where('title', 'like', $filter)
                ->orWhere('content', 'like', $filter);
        });
        if ( $font_id ) $items = $items->where('font_id', $font_id);
  
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

