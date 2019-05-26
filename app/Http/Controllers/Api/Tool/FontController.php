<?php
namespace App\Http\Controllers\Api\Tool;

use Illuminate\Http\Request;

use FontLib\Font;

use App\Http\Requests\Tool\FontRequest as ThisRequest;
use App\Models\Tool\Font as ThisModel;
use App\Transformers\Tool\FontTransformer as ThisTransformer;

class FontController extends Controller { // 包管理
    public function index(Request $request, $parent_id=0) {
        $order_column = $request->query('order_column', 'sort');
        $order_direction = $request->query('order_direction', 'asc');
        $page = $request->query('page', 1);
        $per_page = $request->query('per_page', 20);
        $filter = $request->query('filter', "");
        $language = $request->query('language', "");
        $category = $request->query('category', "");
        $company = $request->query('company', "");
        $weight = $request->query('weight', "");

        $items = new ThisModel;

        if ( $filter ) $items = $items->where(function($query) use ($filter){
            $filter = '%'.$filter.'%';

            return $query->where('title', 'like', $filter)
                ->orWhere('description', 'like', $filter)
                ->orWhere('slug', 'like', $filter);
        });
        if ( $language ) $items = $items->where('language', $language);
        if ( $category ) $items = $items->where('category', $category);
        if ( $company ) $items = $items->where('company', $company);
        if ( $weight ) $items = $items->where('weight', $weight);
  
        $items = $items
            ->orderBy($order_column, $order_direction)
            ->orderBy('id', 'desc')
            ->paginate($per_page);

        return $this->response->paginator($items, new ThisTransformer);
    }
    public function show($id) {
        $item = ThisModel::findOrFail($id);

        $path = storage_path($item->url);
        $font = Font::load($path);
        $font->parse();

        $info = "FontName: " . $font->getFontName() . "\n";
        $info .= "FontFullName: " . $font->getFontFullName() . "\n";
        $info .= "FontPostscriptName: " . $font->getFontPostscriptName() . "\n";
        $info .= "FontSubfamily: " . $font->getFontSubfamily() . "\n";
        $info .= "FontSubfamilyID: " . $font->getFontSubfamilyID() . "\n";
        $info .= "FontVersion: " . $font->getFontVersion() . "\n";
        $info .= "FontCopyright: " . $font->getFontCopyright() . "\n";
        $info .= "FontWeight: " . $font->getFontWeight() . "\n";
        $info .= "FontType: " . $font->getFontType() . "\n";
        $item->info = $info;

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
