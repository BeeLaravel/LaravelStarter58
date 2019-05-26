<?php
namespace App\Http\Controllers\Api\Tool;

use Illuminate\Http\Request;

use App\Http\Requests\Tool\SvgRequest as ThisRequest;
use App\Models\Tool\Svg as ThisModel;
use App\Transformers\Tool\SvgTransformer as ThisTransformer;

use Storage;

class SvgController extends Controller { // 包管理
    public function index(Request $request, $parent_id=0) {
        $order_column = $request->query('order_column', 'sort');
        $order_direction = $request->query('order_direction', 'asc');
        $page = $request->query('page', 1);
        $per_page = $request->query('per_page', 20);
        $filter = $request->query('filter', "");
        $category = $request->query('category', "");
        $md5 = $request->query('md5', "");
        $sha1 = $request->query('sha1', "");

        $items = new ThisModel;

        if ( $filter ) $items = $items->where(function($query) use ($filter){
            $filter = '%'.$filter.'%';

            return $query->where('title', 'like', $filter);
        });
        if ( $md5 ) $items = $items->where('md5', $md5);
        if ( $sha1 ) $items = $items->where('sha1', $sha1);
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
